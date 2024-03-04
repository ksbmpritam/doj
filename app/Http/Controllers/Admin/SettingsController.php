<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function social()
    {
        return view("admin.settings.app.social");
    }

    public function globals()
    {
        return view("admin.settings.app.global");
    }

    public function notifications()
    {
        return view("admin.settings.app.notification");
    }

    public function cod()
    {
        return view('admin.settings.app.cod');
    }

    public function applePay()
    {
        return view('admin.settings.app.applepay');
    }

    public function stripe()
    {
        return view('admin.settings.app.stripe');
    }

    public function mobileGlobals()
    {
        return view('admin.settings.mobile.globals');
    }

    public function razorpay()
    {
        return view('admin.settings.app.razorpay');
    }

    public function paytm()
    {
        return view('admin.settings.app.paytm');
    }

    public function payfast()
    {
        return view('admin.settings.app.payfast');
    }

    public function paypal()
    {
        return view('admin.settings.app.paypal');
    }

    public function adminCommission()
    {
        return view("admin.settings.app.adminCommission");
    }

    public function radiosConfiguration()
    {
        return view("admin.settings.app.radiosConfiguration");
    }

    public function wallet()
    {
        return view('admin.settings.app.wallet');
    }

    public function bookTable()
    {
        return view('admin.settings.app.bookTable');
    }

    public function vatSetting()
    {
        return view('admin.settings.app.vat');
    }

    public function paystack()
    {
        return view('admin.settings.app.paystack');
    }

    public function flutterwave()
    {
        return view('admin.settings.app.flutterwave');
    }

    public function mercadopago()
    {
        return view('admin.settings.app.mercadopago');
    }

    public function deliveryCharge()
    {
        return view("admin.settings.app.deliveryCharge");
    }

    public function languages()
    {
        return view('admin.settings.languages.index');
    }

    public function languagesedit($id)
    {
        return view('admin.settings.languages.edit')->with('id', $id);
    }

    public function languagescreate()
    {
        return view('admin.settings.languages.create');
    }

    public function specialOffer()
    {
        return view('admin.settings.app.specialDiscountOffer');
    }

    public function menuItems()
    {
        return view('admin.settings.menu_items.index');
    }

    public function menuItemsCreate()
    {
        return view('admin.settings.menu_items.create');

    }

    public function menuItemsEdit($id)
    {
        return view('admin.settings.menu_items.edit')->with('id', $id);

    }
    public function story()
    {
        return view('admin.settings.app.story');

    }

    public function footerTemplate()
    {
        return view('admin.footerTemplate.index');
    }

    public function homepageTemplate()
    {
        return view('admin.homepage_Template.index');
    }

}