<?php

namespace API\Handler;

use Phalcon\Mvc\Controller;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once "../vendor/autoload.php";


class Product extends Controller
{

    function check()
    {
        echo "Hello Buddy !!! <br>";
        echo "Ready to use API of My Product APP <br>";
        echo "To use My api first you have to get access token !!!<br>
        To get Access Token Hit this end point '<strong>/api/getToken/{role}</strong>'<br>
        To get list of all product Hit thid end point '<strong>/api/products/get'</strong><br>
        To search products hit this end point '<strong>/api/products/search/{name}</strong>'";
    }

    function getToken($role)
    {
        echo "Ready to get your Access Token  for role " . $role . "<br>";
        $key = "example_key";
        $payload = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "role" => $role
        );
        $jwt = JWT::encode($payload, $key, 'HS256');
        echo $jwt;
    }
    function allproduct()
    {
        $result = "";
        $products = $this->mongo->store->products->find();

        foreach ($products as $p) {

            $result .= json_encode($p);
        }
        echo $result;
    }

    function searchProduct($name)
    {
        $limit = $this->request->getQuery('limit');
        if ($limit != '') {

            $limit = intval($limit);
        } else {

            $limit = -1;
        }
        $name = urldecode($name);
        $array = explode(" ", $name);
        print_r($array);
        $result = '';
        foreach ($array as $val) {
            // $product = $this->mongo->store->products->find(['$or' => [['name' => $val], []]]);
            $product = $this->mongo->store->products->find(['name' => $val]);
            echo "<pre>";
            foreach ($product as $p) {

                // print_r($p);
                if ($limit > 0 || $limit === -1)
                    $result .= json_encode($p);
                if ($limit > 0)
                    $limit--;
            }
        }
        echo $result;
    }
}
