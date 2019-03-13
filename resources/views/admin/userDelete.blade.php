@extends('layouts/adminUserForm')
@section('pageTitle','Delete Account')
@section('formUrl','user/'.$user->id.'/destroy/delete')
@section('method','delete')
@section('nameValue',$user->name)
@section('readonlyName','readonly')
@section('emailValue',$user->email)
@section('readonlyEmail','readonly')
@section('readonly','readonly')
@section('passwordPlaceholder','Can not confirm')
@section('buttonColor','danger')
@section('buttonText','Delete') 