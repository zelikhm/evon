@extends('errors::minimal')

<script>
  window.location.href = '/404';
</script>

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
