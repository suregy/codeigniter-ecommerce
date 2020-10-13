<?php namespace App\Controllers;

class Pages extends BaseController
{
	public function view($page = 'login'){
        if (!file_exists(APPPATH.'Views/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

	//--------------------------------------------------------------------

}
