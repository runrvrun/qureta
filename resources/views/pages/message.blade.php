@extends('layouts.app')

@section('content')
<div class="row">
    <h2>Messages</h2>
    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="#inbox" data-toggle="tab"><i class="fa fa-envelope-o"></i> Inbox</a></li>
        <li><a href="#sent" data-toggle="tab"><i class="fa fa-reply-all"></i> Sent</a></li>
    </ul>

    <div class="tab-content message-list">
        <div class="tab-pane active" id="inbox">
            <a type="button" data-toggle="collapse" data-target="#a1">
                <div class="btn-toolbar well well-sm" role="toolbar"  style="margin:0px;">
                    <div class="btn-group"><input type="checkbox"></div>
                    <div class="btn-group col-md-3">Admin</div>
                    <div class="btn-group col-md-8"><strong>Undangan Lomba Cerpen</strong> 
                        <div class="pull-right">                        
                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg">
                                <i class="fa fa-share-square-o"></i> Reply</a>
                        </div>
                    </div>
                </div>
            </a>
            <div id="a1" class="collapse out well">Halo Sahabat Qureta, ayo ikuti lomba cerpen</div>
            <a type="button" data-toggle="collapse" data-target="#a2">
                <div class="btn-toolbar well well-sm" role="toolbar"  style="margin:0px;">
                    <div class="btn-group"><input type="checkbox"></div>
                    <div class="btn-group col-md-3">Hardiman Said</div>
                    <div class="btn-group col-md-8"><strong>Narasumber</strong> 
                        <div class="pull-right">                        
                            <a class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg">
                                <i class="fa fa-share-square-o"></i> Reply</a>
                        </div>    
                    </div>
                </div>
            </a>
            <div id="a2" class="collapse out well">Halo mas, saya mau ada seminar, butuh narasumber, bisa luangkan waktu untuk ketemu?</div>
            <br>
            <button class="btn btn-primary btn-sm"><i class="fa fa-check-square-o"></i> Delete Checked Item's</button>
        </div>
        <div class="tab-pane" id="sent">
            <a type="button" data-toggle="collapse" data-target="#s1">
                <div class="btn-toolbar well well-sm" role="toolbar"  style="margin:0px;">
                    <div class="btn-group"><input type="checkbox"></div>
                    <div class="btn-group col-md-3">Stephanie Widjaja</div>
                    <div class="btn-group col-md-8"><b>Steph, apa kabar?</b></div>
                </div>                
            </a>
            <div id="s1" class="collapse out well">ini Stephanie anak tarki? apa kabar?</div>
            <a type="button" data-toggle="collapse" data-target="#s2">
                <div class="btn-toolbar well well-sm" role="toolbar"  style="margin:0px;">
                    <div class="btn-group"><input type="checkbox"></div>
                    <div class="btn-group col-md-3">Joko Purnomo</div>
                    <div class="btn-group col-md-8"><b>Referensi</b></div>
                </div>
            </a>
            <div id="s2" class="collapse out well">Mas, mau tanya referensi yang mas pakai untuk tulisan mas apa ya?</div>
            <br>
            <button class="btn btn-primary btn-sm"><i class="fa fa-check-square-o"></i> Delete Checked Item's</button>
        </div>      
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"><br/><br/>
                <form class="form-horizontal">
                    <fieldset>
                        <!-- Text input-->
                        <div class="form-group">             
                            <div class="col-md-8 col-md-offset-2">
                                <input id="body" name="body" type="text" placeholder="Judul" class="form-control input-md" value="Re: Balasan">                
                            </div>
                        </div>

                        <!-- Textarea -->
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">                     
                                <textarea class="form-control" id="message" name="message"></textarea>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="send"></label>
                            <div class="col-md-8">
                                <button id="send" name="send" class="btn btn-primary">Send</button>
                            </div>
                        </div>

                    </fieldset>
                </form>

            </div>
        </div>
    </div>
    @endsection
