<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Response;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;


use League\Glide\Signatures\SignatureFactory;
use League\Glide\Signatures\SignatureException;


class ImageServiceController extends Controller
{
    public function show(Filesystem $filesystem, $path)
    {
        try {
            $signKey = config('services.glide.key');
            SignatureFactory::create($signKey)->validateRequest('img/' . $path, request()->all());

            $server = ServerFactory::create([
                'max_image_size' => 2000 * 2000,
                'response' => new LaravelResponseFactory(app('request')),
                'source' => $filesystem->getDriver(),
                'cache' => $filesystem->getDriver(),
                'source_path_prefix' => '/',
                'cache_path_prefix' => '/.cache',
                'base_url' => 'img',
            ]);

            return $server->getImageResponse($path, request()->all());
        } catch (SignatureException $e) {
            abort(Response::HTTP_UNAUTHORIZED);
        }
    }
}
