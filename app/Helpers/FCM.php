<?php

namespace App\Helpers;

class FCM
{

    protected $apiKey = '';
    protected $apiSendAddress = '';
    protected $payload = [];
    protected $recipients = [];
    protected $message = '';

    public $status = [];
    public $messagesStatuses = [];
    public $responseData = null;
    public $responseInfo = null;


    protected $errorStatuses = [
        'Unavailable' => 'Maybe missed API key',
        'MismatchSenderId' => 'Make sure you\'re using one of those when trying to send messages to the device. If you switch to a different sender, the existing registration IDs won\'t work.',
        'MissingRegistration' => 'Check that the request contains a registration ID',
        'InvalidRegistration' => 'Check the formatting of the registration ID that you pass to the server. Make sure it matches the registration ID the phone receives in the google',
        'NotRegistered' => 'Not registered',
        'MessageTooBig' => 'The total size of the payload data that is included in a message can\'t exceed 4096 bytes',
        'InvalidApnsCredential' => 'Invalid Apns Credential'
    ];

    /**
     * Constructor
     */
    public function __construct()
    {

        $this->apiKey = 'AAAARH2wtYc:APA91bGmvoyP-VBXJTKsfs-XlPZG_DcpSYtpoGo2T99gDHqfHKvlDv2XlB_ds9YLV2FImfSzgKJ-DYJxrPILTtdB5OP1y9XlIw_zw359t8wipACjO3-wYXlfxyU9QzdZaaxY5iCejm3N';
        $this->apiSendAddress = 'https://fcm.googleapis.com/fcm/send';

        if (!$this->apiKey) {
            echo 'GCM: Needed API Key';
        }

        if (!$this->apiSendAddress) {
            echo 'GCM: Needed API Send Address';
        }
    }


    public function setTtl($ttl = '')
    {
        if (!$ttl)
            unset($this->payload['time_to_live']);
        else
            $this->payload['time_to_live'] = $ttl;
    }


    public function setPriority($priority = '')
    {
        if (!$priority)
            unset($this->payload['priority']);
        else
            $this->payload['priority'] = $priority;
    }


    public function setMessage($message = '')
    {

        $this->message = $message;
        $this->payload['data']['message'] = $message;

    }


    public function setData($data = [])
    {

        $this->payload['data'] = $data;

        if ($this->message)
            $this->payload['data']['message'] = $this->message;

    }

    public function setNotification($data = [])
    {

        $this->payload['notification'] = $data;

    }


    public function setContentAvailable($value)
    {
        $this->payload['content_available'] = $value;
    }


    public function setMutableContent($value)
    {
        $this->payload['mutable_content'] = $value;
    }


    /**
     * Setting group of messages
     *
     * @param <string> $group
     */
    public function setGroup($group = '')
    {

        if (!$group)
            unset($this->payload['collapse_key']);
        else
            $this->payload['collapse_key'] = $group;
    }



    public function addRecipients($registrationId)
    {

        $this->payload['registration_ids'][] = $registrationId;
    }


    public function setRecipients($registrationIds)
    {
        $this->payload['registration_ids'] = $registrationIds;
    }



    public function clearRecipients()
    {

        $this->payload['registration_ids'] = [];
    }


    public function send()
    {
        $this->payload['registration_ids'] = array_merge(array_unique($this->payload['registration_ids']), []);

        if (isset($this->payload['time_to_live']) && !isset($this->payload['collapse_key']))
            $this->payload['collapse_key'] = 'Punchmo Notifications';

        $data = json_encode($this->payload);

        return $this->request($data);
    }


    public function sendToTopic($topic)
    {
        $this->payload['to'] = '/topics/' . $topic;

        if (isset($this->payload['time_to_live']) && !isset($this->payload['collapse_key']))
            $this->payload['collapse_key'] = 'Punchmo Notifications';

        $data = json_encode($this->payload);
        return $this->request($data);
    }


    protected function request($data)
    {
        $headers[] = 'Content-Type:application/json';
        $headers[] = 'Authorization:key=' . $this->apiKey;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->apiSendAddress);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $this->responseData = curl_exec($curl);

        $this->responseInfo = curl_getinfo($curl);

        curl_close($curl);


        return $this->parseResponse();
    }


    protected function parseResponse()
    {
        if ($this->responseInfo['http_code'] == 200) {
            $response = explode("\n", $this->responseData);
            $responseBody = json_decode($response[count($response) - 1]);
            $error = 0;
            $message = 'error';
            if (isset($responseBody->success) && $responseBody->success && !$responseBody->failure) {
                $message = 'All messages were sent successfully';
                $error = 0;
            } elseif (isset($responseBody->success) && $responseBody->success && $responseBody->failure) {
                $message = $responseBody->success . ' of ' . ($responseBody->success + $responseBody->failure) . ' messages were sent successfully';
                $error = 1;
            } elseif (isset($responseBody->success) && !$responseBody->success && isset($responseBody->failure) && $responseBody->failure) {
                $message = 'No messages cannot be sent. ' . $responseBody->results[0]->error;
                $error = 1;
            }

            $this->status = array(
                'error' => $error,
                'message' => $message
            );

            $this->messagesStatuses = [];
            if (!empty($responseBody->results)) {
                foreach ($responseBody->results as $key => $result) {
                    if (isset($result->error) && $result->error) {
                        $this->messagesStatuses[$key] = array(
                            'error' => 1,
                            'regid' => $this->payload['registration_ids'][$key],
                            'message' => $this->errorStatuses[$result->error],
                            'message_id' => ''
                        );
                    } else {
                        $this->messagesStatuses[$key] = array(
                            'error' => 0,
                            'regid' => $this->payload['registration_ids'][$key],
                            'message' => 'Message was sent successfully',
                            'message_id' => $result->message_id
                        );
                    }
                }
            }

            return !$error;
        } elseif ($this->responseInfo['http_code'] == 400) {
            $this->status = array(
                'error' => 1,
                'message' => 'Request could not be parsed as JSON'
            );
            return false;
        } elseif ($this->responseInfo['http_code'] == 401) {
            $this->status = array(
                'error' => 1,
                'message' => 'There was an error authenticating the sender account'
            );
            return false;
        } elseif ($this->responseInfo['http_code'] == 500) {
            $this->status = array(
                'error' => 1,
                'message' => 'There was an internal error in the GCM server while trying to process the request'
            );
            return false;
        } elseif ($this->responseInfo['http_code'] == 503) {
            $this->status = array(
                'error' => 1,
                'message' => 'Server is temporarily unavailable'
            );
            return false;
        } else {
            $this->status = array(
                'error' => 1,
                'message' => 'Status undefined'
            );
            return false;
        }
    }

}
