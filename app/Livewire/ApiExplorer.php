<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class ApiExplorer extends Component
{
    public $routes = [];
    public $payloads = [];
    public $responses = [];

    public function mount()
    {
        foreach (Route::getRoutes() as $route) {

            if (!in_array('api', $route->middleware())) {
                continue;
            }

            $methods = array_diff($route->methods(), ['HEAD']);

            $index = count($this->routes);

            $this->routes[] = [
                'uri'     => '/' . $route->uri(),
                'method'  => collect($methods)->first(), // SINGLE method
            ];

            $this->payloads[$index] = "{}";
        }
    }

    public function hitApi($index)
    {
        $route  = $this->routes[$index];
        $method = $route['method'];

        try {
            // 🔥 SAME APP REQUEST (NO HTTP CALL)
            $request = Request::create(
                $route['uri'],
                $method,
                json_decode($this->payloads[$index], true) ?? []
            );

            $response = app()->handle($request);

            $this->responses[$index] = [
                'status' => $response->getStatusCode(),
                'body'   => json_decode($response->getContent(), true)
                            ?? $response->getContent(),
            ];

        } catch (\Throwable $e) {
            $this->responses[$index] = [
                'status' => 'ERROR',
                'body'   => $e->getMessage(),
            ];
        }
    }

    public function render()
    {
        return view('livewire.api-explorer');
    }
}
