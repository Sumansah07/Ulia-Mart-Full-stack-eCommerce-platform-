<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Campaign;
use App\Models\Cart;
use App\Models\Page;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Theme;
use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    # set theme
    public function theme($name = "")
    {
        $settingActiveThemes = getSetting("active_themes");


        $active_themes = $settingActiveThemes != null ? json_decode($settingActiveThemes) : [1];
        $theme = Theme::whereIn('id', $active_themes)->where('code', $name)->first();

        if(session('theme') != $name){
            if (Auth::check()) {
                 Cart::where('user_id', Auth::user()->id)->delete();
            } else {
                 $guestUserId = isset($_COOKIE['guest_user_id']) ? (int) $_COOKIE['guest_user_id'] : 0;
                 Cart::where('guest_user_id', $guestUserId)->delete();
            }
         }

        if(!is_null($theme)){
            session(['theme' => $name]);
        }else{
            flash(localize('The page you are looking for is not available at this moment'))->error();
        }

        return redirect()->route('home');
    }

    # homepage
    public function index()
    {
        $blogs = Blog::isActive()->latest()->take(3);

        if(getTheme() == "default"){
            $blogs = $blogs->get();

            $banners = [];
            $sliders = [];
            if (getSetting('hero_sliders') != null) {
                $sliders = json_decode(getSetting('hero_sliders'));
            }

            $banner_section_one_banners = [];
            if (getSetting('banner_section_one_banners') != null) {
                $banner_section_one_banners = json_decode(getSetting('banner_section_one_banners'));
            }

            $client_feedback = [];
            if (getSetting('client_feedback') != null) {
                $client_feedback = json_decode(getSetting('client_feedback'));
            }
        }else if(getTheme() == "halal"){
            $banners = [];
            $sliders = [];
            $banner_section_one_banners = [];

            $client_feedback = [];
            if (getSetting('halal_client_feedback') != null) {
                $client_feedback = json_decode(getSetting('halal_client_feedback'));
            }

        }else if(getTheme() == "furniture"){
            $blogs = $blogs->get();
            $client_feedback = [];
            $sliders = [];
            $banners = [];

            if (getSetting('furniture_hero_sliders') != null) {
                $sliders = json_decode(getSetting('furniture_hero_sliders'));
            }

            if (getSetting('furniture_banner_section_one_banners') != null) {
                $banners['banner_section_one_banners'] = json_decode(getSetting('furniture_banner_section_one_banners'));
            }

            if (getSetting('furniture_banner_section_two_banners') != null) {
                $banners['banner_section_two_banners'] = json_decode(getSetting('furniture_banner_section_two_banners'));
            }

            if (getSetting('furniture_banner_section_three_banners') != null) {
                $banners['banner_section_three_banners'] = json_decode(getSetting('furniture_banner_section_three_banners'));
            }

            if (getSetting('furniture_banner_section_four_banners') != null) {
                $banners['banner_section_four_banners'] = json_decode(getSetting('furniture_banner_section_four_banners'));
            }

            if (getSetting('furniture_banner_section_five_banners') != null) {
                $banners['banner_section_five_banners'] = json_decode(getSetting('furniture_banner_section_five_banners'));
            }

            if (getSetting('furniture_banner_section_six_banners') != null) {
                $banners['banner_section_six_banners'] = json_decode(getSetting('furniture_banner_section_six_banners'));
            }
        }

        return getView('pages.home', [
            'blogs'     => $blogs,
            'sliders'   => $sliders,
            'banners'   => $banners,
            'banner_section_one_banners' => $banner_section_one_banners ?? null,
            // 'banner_section_two_banners' => $banner_section_two_banners,
            'client_feedback' => $client_feedback
        ]);
    }

    # all brands
    public function allBrands()
    {
        return view('frontend.default.pages.brands');
    }

    # all categories
    public function allCategories()
    {
        return view('frontend.default.pages.categories');
    }

    # get categories HTML for horizontal bar
    public function getCategoriesHtml()
    {
        // Get top-level categories (where parent_id is NULL or 0 or empty string)
        $categories = \App\Models\Category::where(function($query) {
                $query->whereNull('parent_id')
                      ->orWhere('parent_id', 0)
                      ->orWhere('parent_id', '');
            })
            ->orderBy('sorting_order_level', 'asc')
            ->get();

        // Log for debugging
        \Log::info('Server-side categories: Found ' . $categories->count() . ' categories');

        $html = '';

        // If no categories found, use hardcoded ones
        if ($categories->isEmpty()) {
            \Log::warning('No categories found for server-side rendering, using hardcoded fallback');

            $hardcodedCategories = [
                ['id' => 1, 'name' => 'phone'],
                ['id' => 3, 'name' => 'clothes'],
                ['id' => 4, 'name' => 'storee'],
                ['id' => 8, 'name' => 'storeetb'],
                ['id' => 9, 'name' => 'ktm'],
                ['id' => 10, 'name' => 'qwertyu']
            ];

            foreach ($hardcodedCategories as $index => $category) {
                $html .= '<div class="horizontal-bar-item" onclick="window.location.href=\'' . route('products.index') . '?category_id=' . $category['id'] . '\'">';
                $html .= $category['name'];
                $html .= '</div>';

                if ($index < count($hardcodedCategories) - 1) {
                    $html .= '<div class="horizontal-bar-separator">&nbsp;|&nbsp;</div>';
                }
            }
        } else {
            // Use categories from database
            foreach ($categories as $index => $category) {
                $html .= '<div class="horizontal-bar-item" onclick="window.location.href=\'' . route('products.index') . '?category_id=' . $category->id . '\'">';
                $html .= $category->name;
                $html .= '</div>';

                if ($index < count($categories) - 1) {
                    $html .= '<div class="horizontal-bar-separator">&nbsp;|&nbsp;</div>';
                }
            }
        }

        return response($html);
    }

    # all coupons
    public function allCoupons()
    {
        return view('frontend.default.pages.coupons.index');
    }

    # all offers
    public function allOffers()
    {
        return view('frontend.default.pages.offers');
    }

    # all blogs
    public function allBlogs(Request $request)
    {
        $searchKey  = null;
        $blogs = Blog::isActive()->latest();

        if ($request->search != null) {
            $blogs = $blogs->where('title', 'like', '%' . $request->search . '%');
            $searchKey = $request->search;
        }

        if ($request->category_id != null) {
            $blogs = $blogs->where('blog_category_id', $request->category_id);
        }

        $blogs = $blogs->paginate(paginationNumber(5));
        return view('frontend.default.pages.blogs.index', ['blogs' => $blogs, 'searchKey' => $searchKey]);
    }

    # blog details
    public function showBlog($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        return view('frontend.default.pages.blogs.blogDetails', ['blog' => $blog]);
    }

    # get all campaigns
    public function campaignIndex()
    {
        return view('frontend.default.pages.campaigns.index');
    }

    # campaign details
    public function showCampaign($slug)
    {
        $campaign = Campaign::where('slug', $slug)->first();
        return view('frontend.default.pages.campaigns.show', ['campaign' => $campaign]);
    }

    # about us page
    public function aboutUs()
    {
        return view('frontend.default.pages.about-us');
    }

    # contact us page
    public function contactUs()
    {
        return view('frontend.default.pages.contact-us');
    }

    # privacy policy page
    public function privacyPolicy()
    {
        return view('frontend.default.pages.policies.privacy-policy');
    }

    # return and refund policy page
    public function returnRefundPolicy()
    {
        return view('frontend.default.pages.policies.return-refund-policy');
    }

    # shipping and delivery policy page
    public function shippingDeliveryPolicy()
    {
        return view('frontend.default.pages.policies.shipping-delivery-policy');
    }

    # payment policy page
    public function paymentPolicy()
    {
        return view('frontend.default.pages.policies.payment-policy');
    }

    # quick link / dynamic pages
    public function showPage($slug)
    {
        $page = Page::where('slug', $slug)->first();
        return view('frontend.default.pages.quickLinks.index', ['page' => $page]);
    }

    function filterTemplates(){

        $searchKey = null;
        $per_page = 12;
        $max_range = Product::max('max_price');
        $min_value = 0;
        $max_value = formatPrice($max_range, false, false, false, false);
        $tags = Tag::all();

        return view('frontend.default.pages.products.inc.productSidebar',compact('min_value', 'max_value','max_range','tags'));
    }
}
