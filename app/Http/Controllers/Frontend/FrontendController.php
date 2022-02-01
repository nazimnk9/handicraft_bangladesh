<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Logo;
use App\Model\Slider;
use App\Model\Contact;
use App\Model\About;
use App\Model\Communicate;
use App\Model\Company;
use App\Model\Product;
use App\Model\ProductSubImage;
use App\Model\ProductColor;
use App\Model\ProductSize;
use Mail;
use DB;

class FrontendController extends Controller
{
    public function index(){
    	$data['logo'] = Logo::first();
    	$data['sliders'] = Slider::all();
    	$data['contact'] = Contact::first();
        $data['company'] = Company::first();
        $data['categories'] = Product::select('category_id')->groupBy('category_id')->get();
        $data['brands'] = Product::select('brand_id')->groupBy('brand_id')->get();
        $data['products'] = Product::orderBy('id','desc')->paginate(14);
    	return view('frontend.layouts.home',$data);
    }

    public function productList(){
        $data['logo'] = Logo::first();
        $data['company'] = Company::first();
        $data['contact'] = Contact::first();
        $data['products'] = Product::orderBy('id','desc')->paginate(14);
        $data['categories'] = Product::select('category_id')->groupBy('category_id')->get();
        $data['brands'] = Product::select('brand_id')->groupBy('brand_id')->get();
        return view('frontend.single_pages.product-list',$data);
    }

    public function categoryWiseProduct($category_id){
        $data['logo'] = Logo::first();
        $data['company'] = Company::first();
        $data['contact'] = Contact::first();
        $data['products'] = Product::where('category_id',$category_id)->orderBy('id','desc')->get();
        $data['categories'] = Product::select('category_id')->groupBy('category_id')->get();
        $data['brands'] = Product::select('brand_id')->groupBy('brand_id')->get();
        return view('frontend.single_pages.category-wise-product',$data);
    }

    public function brandWiseProduct($brand_id){
        $data['logo'] = Logo::first();
        $data['company'] = Company::first();
        $data['contact'] = Contact::first();
        $data['products'] = Product::where('brand_id',$brand_id)->orderBy('id','desc')->get();
        $data['categories'] = Product::select('category_id')->groupBy('category_id')->get();
        $data['brands'] = Product::select('brand_id')->groupBy('brand_id')->get();
        return view('frontend.single_pages.brand-wise-product',$data);
    }

    public function productDetails($slug){
        $data['logo'] = Logo::first();
        $data['company'] = Company::first();
        $data['contact'] = Contact::first();
        $data['product'] = Product::where('slug',$slug)->first();
        $data['product_sub_images'] = ProductSubImage::where('product_id',$data['product']->id)->get();
        $data['product_colors'] = ProductColor::where('product_id',$data['product']->id)->get();
        $data['product_sizes'] = ProductSize::where('product_id',$data['product']->id)->get();
        return view('frontend.single_pages.product-details',$data);
    }
    public function aboutUs(){
    	$data['logo'] = Logo::first();
    	$data['contact'] = Contact::first();
    	$data['about'] = About::first();
        $data['company'] = Company::first();
    	return view('frontend.single_pages.about-us',$data);
    }

    public function contactUs(){
    	$data['logo'] = Logo::first();
    	$data['contact'] = Contact::first();
        $data['company'] = Company::first();
    	return view('frontend.single_pages.contact-us',$data);
    }

    public function shoppingCart(){
    	$data['logo'] = Logo::first();
    	$data['contact'] = Contact::first();
        $data['company'] = Company::first();
    	return view('frontend.single_pages.shopping-cart',$data);
    }

    public function store(Request $request){
    	$contact = new Communicate();
    	$contact->name = $request->name;
    	$contact->email = $request->email;
    	$contact->mobile_no = $request->mobile_no;
    	$contact->address = $request->address;
    	$contact->msg = $request->msg;
    	$contact->save();

    	$data = array(
    		'name' => $request->name,
    		'email' => $request->email,
    		'mobile_no' => $request->mobile_no,
    		'address' => $request->address,
    		'msg' => $request->msg
    	);

    	Mail::send('frontend.emails.contact',$data, function($message) use($data){
    		$message->from('nazimahmedpro@gmail.com','Handicraft Bangladesh');
    		$message->to($data['email']);
    		$message->subject('Thanks for contact us.');
    	});

    	return redirect()->back()->with('success','Your message successfully sent.');
    }

    public function findSearch(Request $request){
        $search = $request->search;
        $data['news_events'] = NewsEvent::where('search',$search)->first();
        if($data['news_events']){
           $data['logo'] = Logo::first();
           $data['sliders'] = Slider::all();
           $data['contact'] = Contact::first();
           $data['mission'] = Mission::first();
           $data['vision'] = Vision::first();
           $data['services'] = Service::all();
           $data['company'] = Company::first();
           $data['news_events'] = NewsEvent::where('search',$search)->first();
           return view('frontend.single_pages.find-search',$data);
       }else{
        return redirect()->back()->with('error','No post does not match!');
       }
    }

    public function findProduct(Request $request){
        $slug = $request->slug;
        $data['product'] = Product::where('slug',$slug)->first();
        if($data['product']){
            $data['logo'] = Logo::first();
            $data['company'] = Company::first();
            $data['contact'] = Contact::first();
            $data['product'] = Product::where('slug',$slug)->first();
            $data['product_sub_images'] = ProductSubImage::where('product_id',$data['product']->id)->get();
            $data['product_colors'] = ProductColor::where('product_id',$data['product']->id)->get();
            $data['product_sizes'] = ProductSize::where('product_id',$data['product']->id)->get();
            return view('frontend.single_pages.find-product',$data);
        }else{
            return redirect()->back()->with('error','No product does not match!');
        }
    }

    public function getProduct(Request $request){
        $slug = $request->slug;
        $productData = DB::table('products')
        ->where('slug', 'LIKE', '%'.$slug.'%')
        ->get();
        $html = '';
        $html .= '<div><ul>';
        if($productData){
            foreach($productData as $v){
                $html .= '<li>'.$v->slug.'</li>';
            }
        }
        $html .= '</ul></div>';
        return response()->json($html);
    }
}
