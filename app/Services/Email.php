<?php

namespace App\Services;

use App\User;
use Mail;
use Illuminate\Http\Request;


class Email
{

   /* protected $user;

    public function __construct(User $user)
	{
		$this->user = $user;
	}**/

	
	
	public function sendNewRequestImportant($data)
	{
		try {
			Mail::send('emails.newrequestimportant', array('data'=>$data), function ($m) use ($data) {
				$m->from($data[1]->email, $data[1]->name);

				$m->to($data[0]->email, $data[0]->name)->cc('arianneflaure@gmail.com')->subject($data[2]["priorite"] .' '.$data[2]["type"]);
			});
			\Session::flash('info', 'Un mail a été envoyé à votre administrateur.');
		}
			catch(\Exception $e){
			// Never reached
			\Session::flash('warning', 'Problème avec l\'envoi de mail.');
		}
		
	}
	
	public function sendRequestResolu($data)
	{
		
		try {
			Mail::send('emails.requestresolu', array('data'=>$data), function ($m) use ($data) {
				$m->from($data[1]->email, $data[1]->name);
				$m->to($data[0]->email, $data[0]->name)->cc('arianneflaure@gmail.com')->subject('Demande Résolue!');
			
			});
			\Session::flash('info', 'Un mail a été envoyé à votre administrateur.');
		}
			catch(\Exception $e){
			// Never reached
			\Session::flash('warning', 'Problème avec l\'envoi de mail.');
		}
		
	}
	
	/*public function sendConfirmNewOrder($data)
	{
		
		 
		Mail::send('emails.confirmneworder', array('data'=>$data), function ($m) use ($data) {
            $m->from('info@borncici.cm', 'Restaurant Borncici');

		$m->to($data[6]->email, $data[6]->name)->cc('arianneflaure@gmail.com')->subject('Votre Commande a été enregistrée!');
		
		// $m->cc('info@borncici.cm', 'Restaurant  Borncici')->subject('New Order!');
        });
		
	}*/

}