<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


class Authfilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        
        if(!session()->has('isLoggedIn'))
        {
        	return redirect()->to(base_url('/'));
        }

        
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if(session()->has('isLoggedIn') && session()->get('status') !== '1' )
        {
        	return redirect()->to(base_url('/'));
        }
    }
}