@extends('layout.errors',['code'=> array('5','0','0')])
@section('title','Internal Server Error')
@section('message',$exception->getMessage())