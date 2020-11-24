@extends('layouts.admin')
@section('header_style')
<link rel="stylesheet" href="/css/public.css" media="all">
@endsection
@section('body')
<div class="layuimini-container">
    <div class="layuimini-main">
{{-- 
        <textarea name="xxx" id="editorId" cols="230" rows="30"></textarea>
        @component('template.admin.form.editor', ['editor_id' => 'editorId'])
            
        @endcomponent --}}
        @component('template.admin.form.multipic', ['editor_id' => 'editorId'])
            
        @endcomponent
    </div>
</div>
@endsection
@section('footer_js')
 
@endsection