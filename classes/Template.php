<?php 
	include_once('Config.php');
	class Template
	{
		function getCartTemplate($cart_row)
		{
		        $str="<div class='item'><div class='delete' data-pro-code='$cart_row[product_code]'>X</div>
                                                <div class='row'>
                                                      <div class='col-sm-6 col-xs-6 group'>
                			     	<a class='thumb' href='shop-single-dr.html'><img class='cart-thumb' src='".Config::$basePath."/img/products/products-thumb/".$cart_row['product_cart_image']."' alt='Thumb'/></a>
                                                            <div class='details'>
                                                                  <h4><a href='shop-single-dr.html'>$cart_row[product_name]</a></h4>
                                                                  <div class='color-switcher'>
                                                                        <span><strong>Model-</strong></span>
                                                                        <span>Jai Mata Di</span>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                      <div class='col-xs-3 hidden-xs'>
                                                            <div class='qnt-count'>
                                                                  <a class='incr-btn fa fa-angle-left inactive' data-action='decrease' href='#'></a>
                                                                  <input class='quantity' type='text' value='$cart_row[cart_quantity]'>
                                                                  <a class='incr-btn fa fa-angle-right' data-action='increase' href='#'></a>
                                                                  <a class='muted update-cart' href='#' style='display: block;padding-top: 8px;clear: both;text-align: center;'>Update Cart</a>
                                                            </div>
                                                      </div>
                                                      <div class='col-sm-3 col-xs-6'>
                                                            <div class='price'>$cart_row[product_price]&nbsp;&nbsp;<i class='fa fa-rupee'></i></div>
                                                      </div>
                                                </div>
                                          </div>";
                                          return $str;
		}
                                    function getDropdownTemplate($cart_row,$cart_count)
                                    {
                                          $str ="<div class='item' id='$cart_row[product_code]' data-position='".($cart_count-1)."'>
                                                            <div class='delete'><i class='fa fa-angle-right'></i><i class='fa fa-angle-left'></i></div>
                                                            <a href='shop-single-dr.html'>
                                                                  <span class='name'>$cart_row[product_name]</span>
                                                                  <span class='price'>$cart_row[product_price]<i class='fa fa-rupee'></i></span>
                                                                  <span class='overlay'></span>
                                                                  <img src='".Config::$basePath."/img/products/products-thumb/".$cart_row['product_cart_image']."' alt='Item01'/>
                                                            </a>
                                                            <div class='qnt-count'>
                                                                  <a class='incr-btn fa fa-angle-left inactive' data-action='decrease' href='#'></a>
                                                                  <input class='quantity' type='text' value='$cart_row[cart_quantity]'>
                                                                  <a class='incr-btn fa fa-angle-right' data-action='increase' href='#'></a>
                                                            </div>
                                                      </div>";
                                              return $str;        
                                    }
	}
?>