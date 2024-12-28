<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\RequestLog;

class LogRequest
{
    public function handle(Request $request, Closure $next)
    {
        // Tangkap data request sebelum diteruskan ke request berikutnya
		$input = file_get_contents('php://input');
		$content = (empty($input))?$request->getContent():$input;

		//$content = $request->getContent();
		$_SESSION['raw_input'] = $content;

        // Simpan data request ke dalam database
        RequestLog::create([
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'headers' => json_encode($request->headers->all()),
            'body' => $content,
            'query' => json_encode($request->query()),
            'ip_address' => $request->ip(),
        ]);
		
		$response = $next($request);
        return $response;
    }
}
