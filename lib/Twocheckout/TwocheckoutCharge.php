<?php

class Twocheckout_Charge extends Twocheckout
{

    public static function form($params, $type='Checkout', $mode='')
    {
        if ($mode == 'sandbox') {
            echo '<form id="2checkout" action="https://sandbox.2checkout.com/checkout/purchase" method="post">';
        } else {
            echo '<form id="2checkout" action="https://www.2checkout.com/checkout/purchase" method="post">';
        } 


        foreach ($params as $key => $value)
        {
            echo '<input type="hidden" name="'.$key.'" value="'.$value.'"/>';
        }
        if ($type == 'auto') {
            echo '<input type="submit" value="Click here if you are not redirected automatically" /></form>';
            echo '<script type="text/javascript">document.getElementById("2checkout").submit();</script>';
        } else {
            echo '<input type="submit" value="'.$type.'" />';
            echo '</form>';
        }
    }

    public static function direct($params, $type='Checkout', $mode='')
    {

        if ($mode == 'sandbox') {
            echo '<form id="2checkout" action="https://sandbox.2checkout.com/checkout/purchase" method="post">';
        } else {
            echo '<form id="2checkout" action="https://www.2checkout.com/checkout/purchase" method="post">';
        } 

        foreach ($params as $key => $value)
        {
            echo '<input type="hidden" name="'.$key.'" value="'.$value.'"/>';
        }

        if ($type == 'auto') {
            echo '<input type="submit" value="Click here if the payment form does not open automatically." /></form>';
            echo '<script type="text/javascript">
                    function submitForm() {
                        document.getElementById("tco_lightbox").style.display = "block";
                        document.getElementById("2checkout").submit();
                    }
                    setTimeout("submitForm()", 2000);
                  </script>';
        } else {
            echo '<input type="submit" value="'.$type.'" />';
            echo '</form>';
        }

        echo '<script src="https://www.2checkout.com/static/checkout/javascript/direct.min.js"></script>';
    }

    public static function link($params, $mode='')
    {

         if ($mode == 'sandbox') {
             $url = 'https://sandbox.2checkout.com/checkout/purchase?'.http_build_query($params, '', '&amp;');
        } else {
             $url = 'https://www.2checkout.com/checkout/purchase?'.http_build_query($params, '', '&amp;');
        }        


        return $url;
    }

    public static function redirect($params, $mode='')
    {
         if ($mode == 'sandbox') {
                    $url = 'https://sandbox.2checkout.com/checkout/purchase?'.http_build_query($params, '', '&amp;');
        } else {
                    $url = 'https://www.2checkout.com/checkout/purchase?'.http_build_query($params, '', '&amp;');
        }        
        header("Location: $url");
    }

    public static function auth($params=array())
    {
        $request = new Twocheckout_Api_Requester();
        $result = $request->do_auth_call($params);
        return Twocheckout_Util::return_resp($result, $format='array');
    }

}
