<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponder
{
    protected $responseArray = [];
    protected $responseHttpCode = Response::HTTP_OK;


    public function setSuccess($message = null)
    {
        $this->setStatus(true, $message);
        return $this;
    }


    public function setError($message = 'Status Message')
    {
        $this->setStatus(false, $message);
        return $this;
    }


    public function addResource(JsonResource $resource, $key = 'data')
    {
        $this->addResponseField($key, $resource);

        if ($resource->resource && $resource->resource instanceof LengthAwarePaginator) {
            $this->addPagination($resource->resource);
        }
        return $this;
    }


    public function addResponseArray($arr = NULL)
    {
        if ($arr && count($arr)) {
            $this->responseArray = array_merge($this->responseArray, $arr);
        }
        return $this;
    }


    public function addValidationErrors($condition, \Closure $closure)
    {
        if ($condition) {
            $errors = [];

            foreach ($closure() as $key => $value) {
                $errors[$key] = $value[0];
            }

            $this->responseArray['status']['errors'] = $errors;

            if (isset($errors['sessions']) && $errors['sessions'] == trans('alerts.you_have_an_appointment_in_this_time')) {
                $this->addResponseField('b_have_appointment_with_others', true);
            }
        }

        return $this;
    }


    public function addResponseArrayWhen($condition, array $arr)
    {
        if ($condition) {
            $this->addResponseArray($arr);
        }

        return $this;
    }

    public function addResponseFiledWhen($condition, $value, $key)
    {
        if ($condition) {
            $this->addResponseField($key, $value);
        }

        return $this;
    }


    protected function addPagination($pagination)
    {

        $pagination = [
            'i_total_objects' => (int) $pagination->total(),
            'i_items_on_page' => (int) $pagination->count(),
            'i_per_page' => (int) $pagination->perPage(),
            'i_current_page' => $pagination->currentPage(),
            'i_total_pages' => $pagination->lastPage(),
        ];

        $this->addResponseArray(['pagination' => $pagination]);

        return $this;
    }


    protected function setStatus($success = TRUE, $message = 'Status Message')
    {
        $status = array();
        if (is_bool($success)) $status['status']['success'] = $success;
        if (!is_null($message) && is_string($message)) $status['status']['message'] = $message;

        if (count($status)) {
            $this->addResponseArray($status);
        }

        return $this;
    }


    public function setHttpCode($httpCode = NULL)
    {
        $this->responseHttpCode = $httpCode ? $httpCode : Response::HTTP_OK;
        $this->responseArray['status']['code'] = $this->responseHttpCode;
        return $this;
    }


    public function addResponseField($name, $value)
    {
        $this->responseArray[$name] = $value;
        return $this;
    }


    public function successResponse($message, $data = null, $key = 'data', $statusCode = Response::HTTP_OK)
    {
        $this->setSuccess($message);
        $this->setHttpCode($statusCode);

        if ($data) {
            if (is_array($data)) {
                $this->addResponseField($key, $data);
            } elseif ($data instanceof Collection || $data instanceof EloquentCollection) {
                $this->addResponseField($key, $data);
            } else {
                $this->addResource($data, $key);
            }
        }

        return $this->getResponse();
    }


    public function failResponse($message, $data = null, $key = null, $statusCode = Response::HTTP_BAD_REQUEST)
    {
        $this->setError($message);
        $this->setHttpCode($statusCode);
        if ($data) $this->addResource($data, $key);
        return $this->getResponse();
    }


    public function createdResponse($message, $data, $key = 'data')
    {
        return $this->successResponse($message, $data, $key, Response::HTTP_CREATED);
    }


    public function noContentResponse($message)
    {
        return $this->failResponse($message, null, null, Response::HTTP_NO_CONTENT);
    }


    public function unauthenticatedResponse($message)
    {
        return $this->failResponse($message, null, null, Response::HTTP_UNAUTHORIZED);
    }


    public function notFoundResponse($message = 'not found')
    {
        $this->setError($message);
        $this->setHttpCode(Response::HTTP_NOT_FOUND);
        return $this->getResponse();
    }


    public function getResponse()
    {
        return response($this->responseArray, $this->responseHttpCode);
    }
}
