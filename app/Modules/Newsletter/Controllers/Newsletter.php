<?php 
namespace Modules\Newsletter\Controllers;

use Core\Controller;
use Core\View;
use Core\Router;
use Helpers\Url;
use Helpers\Paginator;
use Helpers\Session;

class Newsletter extends Controller 
{ 
    
	public function __construct(){
        
        parent::__construct();
        //$this->newsletter = new \Modules\Recherche\Models\Recherche();
        
	}
    
    public function routes(){
        
		//Router::any('new/(:any)', 'Modules\Recherche\Controllers\Recherche@results');
        //Router::any('recherche-marque/(:num)/(:any)', 'Modules\Recherche\Controllers\Recherche@resultsByMarque');
	}

    /**
     * Display Form View
     */
    public function index()
    {
        
        View::renderModule('Newsletter/view/index');
        
    }
    
    
    /**
     * Display Results View
     
    public function results($value = null)
    {
        
        if(isset($_GET['code'])):
            //Replace Accents in String Search
            $keyword_accent = Url::replaceAccentedChars($_GET['code']);
            $keyword = urlencode($keyword_accent);
            //Redirect to search page
           Url::redirect('recherche/' . $keyword);
        endif;
        
        if(!empty($value)){
            $data['title'] = urldecode($value);
            $data['keyword'] = urldecode($value);
            
            if($value == '+'):
                $data['message_erreur'] = 'Code ou Nom de teinte obligatoire';
            endif;
            
            $pages = new Paginator(TEINTES_PAR_PAGE, 'p');
            $data['modele'] = $this->recherche->searchbycode($data['keyword'], $pages->getLimit()); // Get Teintes
            $data['count_results'] = count($this->recherche->search_total($data['keyword']));
            $pages->setTotal($data['count_results']); // Count Nb of Results
            $data['pageLinks'] = $pages->pageLinks(); // Display Page Links

            if($data['count_results'] == '0'):
                $data['message'] = "Aucun résultat trouvé";
            elseif($data['count_results'] == '1'):
                $data['message'] = $data['count_results'].' résultat trouvé';
            else:
                $data['message'] = $data['count_results'].' résultats trouvés';
            endif;
            
            
        } else {
          $data['title'] = 'Recherche';
        }

        View::renderTemplate('header',$data);
		View::renderModule('Recherche/view/results',$data);
		View::renderTemplate('footer',$data);
        
    }*/
    
    
    /**
     * Display Results View : SEARCH BY MARQUE
     
    public function resultsByMarque($id_marque = null, $motcle = null)
    {
        
        if(isset($_GET['code'])):
            // Replace Accents in String Search
            $keyword_accent = Url::replaceAccentedChars($_GET['code']);
            $keyword = urlencode($keyword_accent);
            
            // Redirect to search page
            Url::redirect('recherche-marque/'.$id_marque.'/'.$keyword);
        endif;
        
        if(!empty($motcle)){
            $data['title'] = urldecode($motcle);
            $data['keyword'] = urldecode($motcle);
            
            if($id_marque == '+'):
                $data['message_erreur'] = 'Code ou Nom de teinte obligatoire';
            endif;
            
            $pages = new Paginator(TEINTES_PAR_PAGE, 'p');
            $data['modele'] = $this->recherche->searchbycodebymarque($data['keyword'], $id_marque, $pages->getLimit()); // Get Teintes
            $data['count_results'] = count($this->recherche->searchbycodebymarque_total($data['keyword'], $id_marque));
            $pages->setTotal($data['count_results']); // Count Nb of Results
            $data['pageLinks'] = $pages->pageLinks(); // Display Page Links

            if($data['count_results'] == '0'):
                $data['message'] = "Aucun résultat trouvé";
            elseif($data['count_results'] == '1'):
                $data['message'] = $data['count_results'].' résultat trouvé';
            else:
                $data['message'] = $data['count_results'].' résultats trouvés';
            endif;
            
            
        } else {
          $data['title'] = 'Recherche';
        }

        View::renderTemplate('header',$data);
		View::renderModule('Recherche/view/results',$data);
		View::renderTemplate('footer',$data);
        
    }*/

 }