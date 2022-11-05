<?php
namespace MelhorEnvio\Http\Controllers;
    use App\Http\Controllers\Controller;
    use App\Models\Config;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\Storage;
    class MelhorEnvioConfigsController extends Controller {
        public function create()
        {
           return view('melhorenvio::configs.create');
        }
        public function store(Request $request)
        {
          

                $request->validate([
                    'technicalemail' => 'required|string|email|max:255',
                    'token' => 'required|string|max:255',
                    'sandbox' => 'required',
                    'clientid' => 'required|string|max:255',
                    'secretkey' => 'required|string|max:255',
                    'pixtoken' => 'required|string',
                ]);
        
          
            
            foreach($request->request as $key=>$value){
               
              if(($key!='_token')&&($key!='certificatepixpem')&&($key!='certificatepixkey')){
                Config::createOrUpdate('plugins/payments/pagseguro/'. $key,$value);
              }  
                   
              
            }
   
            return redirect()->back()->with("success", "Settings saved successfully");
        
        }
    protected function validator(array $data)
    {
      
        return Validator::make($data, [
            // User data
           
            'email' => ['required', 'string', 'email', 'max:255'],
            'token' => ['required', 'string', 'max:255'],
            'sandbox' => ['required'],

        ]);
  
    }



    



    }