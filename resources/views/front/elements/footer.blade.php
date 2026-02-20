<?php
use Illuminate\Support\Facades\Route;
$routeName    = Route::current();
$pageName     = explode("/", $routeName->uri());
$pageSegment  = $pageName[0];
?>
<a href="<?= url('home') ?>" <?= (($pageSegment == 'home')?'class="active"':'') ?>><i class="fas fa-home"></i>Home</a>
<a href="<?= url('events') ?>" <?= (($pageSegment == 'events')?'class="active"':'') ?>><i class="fas fa-calendar"></i>Events</a>
<a href="<?= url('news') ?>" <?= (($pageSegment == 'news')?'class="active"':'') ?>><i class="fas fa-file"></i>News</a>
<a href="<?= url('awards') ?>" <?= (($pageSegment == 'awards')?'class="active"':'') ?>><i class="fas fa-trophy"></i>Awards</a>
<a href="<?= url('magazines') ?>" <?= (($pageSegment == 'magazines')?'class="active"':'') ?>><i class="fas fa-file-pdf"></i>Magazine</a>
<a href="<?= url('media') ?>" <?= (($pageSegment == 'media')?'class="active"':'') ?>><i class="fas fa-microphone"></i>Media</a>