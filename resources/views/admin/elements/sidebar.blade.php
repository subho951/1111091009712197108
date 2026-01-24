<?php
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductImage;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Route;
$routeName    = Route::current();
$pageName     = explode("/", $routeName->uri());
$pageSegment  = $pageName[1];
$pageFunction = ((count($pageName)>2)?$pageName[1]:'');
$parameters   = $routeName->parameters();
// dd($routeName);
if(!empty($parameters)){
  if (array_key_exists("id1",$parameters)){
    $pId1 = Helper::decoded($parameters['id1']);
  } else {
    $pId1 = Helper::decoded($parameters['id']);
  }
  if(count($parameters) > 1){
    $pId2 = Helper::decoded($parameters['id2']);
  }
}
?>
<ul class="sidebar-nav" id="sidebar-nav">
  <li class="nav-item">
    <a class="nav-link <?=(($pageSegment == 'dashboard')?'active':'')?>" href="{{ url('admin/dashboard') }}">
      <i class="fa fa-home"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->  

  <?php if(in_array(32, $module_id)){?>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'email-logs')?'active':'')?>" href="{{ url('admin/email-logs') }}">
        <i class="fa fa-envelope"></i>
        <span>Email Logs</span>
      </a>
    </li><!-- End Profile Page Nav -->
  <?php }?>

  <?php if(in_array(33, $module_id)){?>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'login-logs')?'active':'')?>" href="{{ url('admin/login-logs') }}">
        <i class="fa fa-list"></i>
        <span>Login Logs</span>
      </a>
    </li><!-- End Profile Page Nav -->
  <?php }?>

  <?php if(in_array(35, $module_id)){?>
    <li class="nav-item">
      <a class="nav-link <?=(($pageSegment == 'settings')?'active':'')?>" href="{{ url('admin/settings') }}">
        <i class="fa fa-cogs"></i>
        <span>Account Settings</span>
      </a>
    </li><!-- End Profile Page Nav -->
  <?php }?>
</ul>