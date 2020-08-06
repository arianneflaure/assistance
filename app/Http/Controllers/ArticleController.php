<?php

namespace App\Http\Controllers;

use App\Article;
// use App\DB;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation;
use App\Services\Email;
use Session;

class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $articleRepository;
    protected $nbrePerPage = 10;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->middleware('auth',['except' =>'index','update']);
        $this->middleware('admin',['only'=>'destroy']);
        
        $this->articleRepository = $articleRepository;
        
    }

    

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'titre' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'contenu' => 'required|text',
            'type' => 'required|string',
            'user_id' => 'required|numeric',
            'priorite' => 'required|string',
            'statut' => 'required|text',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function exportCsv(Request $request)
	{
		$fileName = 'demandes.csv';
		
		$data = $this->articleRepository->getAll();
		
		if (auth()->user()->role==='admin') {
			$data = $this->articleRepository->getAllForAdmin();
		}
		if( isset($request->statut) ){
			$data = $data->where(['statut'=>$request->statut]);
		}
		if( isset($request->from) ){
			$data = $data->whereDate('created_at','=',date("Y/m/d",strtotime($request->from)));
		}
		/*if(( isset($request->from) ) && ( isset($request->statut) )){
			$data = $this->articleRepository->search(['statut'=>$request->statut])->get();
		}*/
		
		$data=$data->orderBy('articles.created_at', 'desc')->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Titre', 'Administrateur', 'Priorite', 'Statut', 'Date', 'Message');

        $callback = function() use($data, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($data as $task) {
                $row['Titre']  = $task->titre;
                $row['Administrateur']    = $task->admin->name;
                $row['Priorite']    = $task->priorite;
                $row['Statut']    = $task->statut;
                $row['Date']  = $task->created_at->format('d-m-Y');
                $row['Message']  = $task->contenu;

                fputcsv($file, array($row['Titre'], $row['Administrateur'], $row['Priorite'], $row['Statut'], $row['Date'],$row['Message']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function index(Request $request)
    {
		$user = Auth::user();
		$vue='articles.index';
		$statut='';
		
		
			$all = $this->articleRepository->getAll();
       
		
			if( isset($request->statut) ){
				$all = $this->articleRepository->getByStatus($request->statut);
				$statut=$request->statut;
			}
			
			if( isset($request->priorite) ){
				//$all = $this->articleRepository->getByPriorite($request->priorite);
			}
			
		$all=$all->orderBy('created_at', 'desc');	
		$count = count($all->get());
		$articles = $all->paginate($this->nbrePerPage);
		$links = $articles->render();
		
        return view($vue,compact('articles','links','count','statut'));
    }
	
	
	  public function admin(Request $request)
    {
		$user = Auth::user();
		$statut='';
		
		$all = $this->articleRepository->getAllForAdmin();
		$vue='articles.admin';
		
		
		if( isset($request->statut) ){
			$all = $this->articleRepository->getByStatusForAdmin($request->statut);
			$statut=$request->statut;
		}
			
		if( isset($request->priorite) ){
			// $all = $this->articleRepository->getByPrioriteForAdmin($request->priorite);
			$all = $all->where('priorite', $request->priorite);
		}
		
		$priorite=$request->priorite;
			
		$all=$all->orderBy('created_at', 'desc');		
		$count = count($all->get());
		$articles = $all->paginate($this->nbrePerPage);
		$links = $articles->render();
        return view('articles.admin',compact('articles','links','count','priorite','statut'));
    }

    public function indexresolues()
    {$user = Auth::user();
        
        
        $resolues =$articles->where('statut','Résolu');
        
        
        return view('articles.resolues',compact('resolues'));
    }

    public function indexnonresolues()
    {$user = Auth::user();
        
        
        $articles = $this->articleRepository->getPaginate($this->nbrePerPage);
        $nonresolues =$articles->where('statut','Non Résolu');
        $links = $nonresolues->render();
        
        return view('articles.index',compact('nonresolues','links'));
    }

    public function indexurgentes()
    {$user = Auth::user();
        
        
        $articles = $this->articleRepository->getPaginate($this->nbrePerPage);
        $urgentes =$articles->where('priorite','Urgent');
        $links = $urgentes->render();
        
        return view('articles.index',compact('urgentes','links'));
    }

    public function indextresurgentes()
    {$user = Auth::user();
        
        
        $articles = $this->articleRepository->getPaginate($this->nbrePerPage);
        $tresurgentes =$articles->where('priorite','Très Urgent');
        $links = $resurgentes->render();
        
        return view('articles.index',compact('tresurgentes','links'));
    }

    public function indexnourgentes()
    {$user = Auth::user();
        
        
        $articles = $this->articleRepository->getPaginate($this->nbrePerPage);
        $nourgentes =$articles->where('priorite','Intermediaire');
        $links = $nourgentes->render();
        
        return view('articles.intermediaire',compact('nourgentes','links'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function count(Article $article)
    {
        return back();
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {   
        $user = Auth::user();
        $data['used_name'] = $user->name;
		
        $listAdmin = User::where('role','admin')->get();
    
        return view('articles.create', compact('data','listAdmin'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        /*$user = Auth::user();
        $user->articles()->create($request->all());*/
		$getimageName='';
        if($request->hasFile('image')) {
        $path = $request->file('image');
        $getimageName = time().'.'.$path->getClientOriginalName();
        $path->move(public_path('/images/articles/'), $getimageName);
        
        }
        
        $user = Auth::user();
        
        $article=$request->all();
        $article["image"]=$getimageName;

        $user->articles()->create($article);
		\Session::flash('success', 'Votre requete a été enregistrée avec succès.');
		
		if($request->priorite!='Intermediaire'){
			$email= new Email;
			$receiverUser=User::find($request->admin_user);//$request->admin_user
			$data=[$receiverUser, $user,$request->all(),$request->created_at ];
			$email->sendNewRequestImportant($data);
		}
        

        
        return Redirect::to('articles');
		
		//->
        // with('success','Great! Article created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
        $user = Auth::user();
        $article = Article::find($id);
		
        return view('articles.show',compact('article'));
    
    }
	
	 public function showForAdmin($id)
    {
        $user = Auth::user();
		$record_per_page=3;
		$total_records=$this->articleRepository->getByStatus('Résolu')->count();
        $article = Article::find($id);
		
		$all = $this->articleRepository->getByStatus('Résolu');
		$articlesresolues = $all->paginate($record_per_page);
		$total_pages = ceil($total_records/$record_per_page);
		// $links = $articlesresolues->render();
		
        return view('articles.showadmin',compact('article', 'articlesresolues','total_pages'));
    
    } 
	public function paginateArticlesResolues(Request $request)
    {
        $user = Auth::user();
		$record_per_page=3;
		$total_records=$this->articleRepository->getByStatus('Résolu')->count();
        
		 if(isset($request->page))  
		 {  
			  $page = $request->page;  
		 }  
		 else  
		 {  
			  $page = 1;  
		 }
		
		// $all = $this->articleRepository->getByStatus('Résolu');
		$start_from = ($page - 1)*$record_per_page;
		$articlesresolues = DB::table('articles')
                ->where('statut','Résolu')
                ->offset($start_from)
                ->limit($record_per_page)
                ->get();		
		
		$output='';
		$total_pages = ceil($total_records/$record_per_page);
		foreach ($articlesresolues as $a){
		$output=$output.'<div class="panel-group" ><div class="panel"><div class="panel-heading">'
				.'<input type="hidden" id="'.$a->id.'"  value="'.$a->titre.'" />'
				.'<h4 class="panel-title"><input type="radio" name="requete" class="list-child" value="'.$a->id.'" />'
				.'<a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$a->id.'" aria-expanded="false" class="collapsed">'.$a->titre.'</a>'
				.'</h4></div><div id="collapse'.$a->id.'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">'
				.'<div class="panel-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf mccusamus labore sustainable VHS.'
				.'</div></div></div></div>';
		}
		
		// return json_encode($articlesresolues);
		echo $output;
		
       // return view('articles.showadmin',compact( 'articlesresolues','total_pages'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        
        return view('articles.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        
        $article->update($request->all());
    
        return redirect()->route('articles.index');
    }
	
	public function updatestatut(Request $request)
    {       
        $article=Article::find($request->article_id);
        $article->statut ='Résolu';
        $article->save();
		$email= new Email;
		$receiverUser=User::find($article->admin_user);//$request->admin_user
		$senderUser=User::find($article->user_id);//$request->admin_user
		$data=[$receiverUser, $senderUser, $article];
		$email->sendRequestResolu($data);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter($filter)
    {
        $filter =$filter-> input('filter');
        $articles = $this->articleRepository->getFilter($this->nbrePerPage,$filter);
        $statuts = $articles->render();
        return view('articles.index',compact('articles','statuts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
