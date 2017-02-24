<div>
    <!-- /.panel -->
    <div class="row">
        <div class="col-md-4">
            <input type="hidden" data-ng-model="agentId" placeholder="Agent Id" class="form-control">
            <div class="portlet light">                
                    <div class="portlet-body form">
                        <div class="intraction-contener">
                        <div class="intraction-controll">    
                                <div class="deny {{denyBtn_show_hide?denyBtn_show_hide:'ng-hide'}}" data-ng-click="deny()"><i class="fa fa-phone"></i></div>
                                <div class="receive {{answerBtn_show_hide?answerBtn_show_hide:'ng-hide'}}" ng-click="receive()"></div>
                                <div class="disconnected  {{disconnected_show_hide?disconnected_show_hide:'ng-hide'}}" >Disconnected</div>
                                <div class="callback  {{callback_show_hide?callback_show_hide:'ng-hide'}}" ng-click="receive()" >
                                    <img src="images/callbackIcon.png" alt="Call Back">Call Back
                                </div>
                                <div class="intraction-loader {{agentIntractionLoader_show_hide?agentIntractionLoader_show_hide:'ng-hide'}}"><img src="images/ajax-modal-loading.gif" alt="Processing..." /></div>
                                <div class="video-stream {{agentVideoDisable_show_hide?agentVideoDisable_show_hide:'ng-hide'}} {{videoDisable?videoDisable:'enable'}}" ng-click="agentToggleVideoDisable()"><i class="fa fa-video-camera"></i></div>
                            </div>
                            
                            <div id="videos">
                                <div id="subscriber"></div>
                                <div id="publisher"></div>
                            </div>
                        </div>
                    </div>                
            </div>
            
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                            <i class="fa fa-cogs font-green-sharp"></i>
                            <span class="caption-subject font-green-sharp bold uppercase">Chat Box</span>
                    </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-group">
                                <input type="hidden" data-ng-model="name" placeholder="Enter Name" class="form-control">
                                
                        </div>
                       <ul id="example-messages" class="chatUl example-chat-messages">
                                <li data-ng-repeat="msg in messages" class="{{msg.type=='agent'?'agent':'client'}}" >
                                  <span class="photo {{messages[$index-1].type == msg.type?'sameuser-msg':''}}"  >
                                   
                                    <span class="dotmsg {{messages[$index-1].type == msg.type?'':'ng-hide'}}">...</span>
                                    <i  class="glyphicon glyphicon-user {{messages[$index-1].type != msg.type?'':'ng-hide'}}" ></i>
                                    </span>
                                  <span class="subject">
                                    <span class="from {{messages[$index-1].type != msg.type?'':'ng-hide'}}" >{{msg.from}}</span>
                                    <!--<span class="time">2 hrs </span>-->
                                    </span>
                                  <span class="message">
                                   {{ msg.body }} 
                                  </span>
                                 
                                </li >
                        </ul>
                       
                        <div class="form-group">
                               
                                <div class="input-group">
                                        <span class="input-group-addon">
                                        <i class="fa fa-envelope" data-ng-hide="loadShow"></i>
                                        <img src="../assets/admin/layout3/img/loading-spinner-grey.gif" data-ng-show="loadShow"/>
                                        </span>
                                        <input type="text" data-ng-model="msg" ng-keydown="addMessage($event)" placeholder="Enter Text" class="form-control">
                                </div>
                                
                                    
                               
                        </div>
                        
                        <div class="form-group">
                            <button class="col-md-12 btn btn-success" data-ng-click="closeChat($event)" data-ng-show="intractionstatus">
                                Close Interaction
                                
                            </button>
                        </div>

                       
                    </div>
                
            </div>
        </div>
            <div class="col-md-8">
          <div class="span9special mapper">
      <div class="map-unit">
        <div class="map-points">
            
            <a href="javascript:void(0);" class="map-point" id="launceston" title="launceston" data-ng-click="setPoniter($event)"  ><i class="fa fa-map-marker"> </i>Launceston</a>
            
            <a href="javascript:void(0);" class="map-point" id="hobart" title="hobart" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"> </i> Hobart</a>
            
            <a href="javascript:void(0);" class="map-point" id="northernterritory" title="northernterritory" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"> </i> Northern Territory </a>
            
            <a href="javascript:void(0);" class="map-point" id="kakadunp" title="kakadunp" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Kakadu NP</a>
            
            <a href="javascript:void(0);" class="map-point" id="darwin" title="darwin" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Darwin</a>
            
            <a href="javascript:void(0);" class="map-point" id="katatjutatheolgas" title="katatjutatheolgas" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Kata Tjuta (The Olgas)</a>
            
            <a href="javascript:void(0);" class="map-point" id="kingscanyon" title="kingscanyon" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Kings Canyon</a>
            
            <a href="javascript:void(0);" class="map-point" id="uluru" title="uluru" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Uluru</a>
            
            <a href="javascript:void(0);" class="map-point" id="alicesprings" title="alicesprings" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Alice Springs</a>
            
            <a href="javascript:void(0);" class="map-point" id="queensland" title="queensland" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Queensland</a>
            
            <a href="javascript:void(0);" class="map-point" id="capeyork" title="capeyork" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Cape York</a>
            
            <a href="javascript:void(0);" class="map-point" id="portdouglas" title="portdouglas" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Port Douglas</a>
            
            <a href="javascript:void(0);" class="map-point" id="capetribulation" title="capetribulation" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Cape Tribulation</a><a href="#" class="map-point" id="cairns" title="cairns" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Cairns</a>
            
            <a href="javascript:void(0);" class="map-point" id="greatbarrierreef" title="greatbarrierreef" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Great Barrier Reef</a>
            
            <a href="javascript:void(0);" class="map-point" id="missionbeach" title="missionbeach" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Mission Beach</a>
            
            <a href="javascript:void(0);" class="map-point" id="tully" title="tully" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Tully</a>
            
            <!--<a href="<?php echo FRONTEND_URL;?>queensland/tully/" class="map-point" id="emupark" title="emupark" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Emu Park</a>-->
            
            <a href="javascript:void(0);" class="map-point" id="townsville" title="townsville" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Townsville</a>
            
            <a href="javascript:void(0);" class="map-point" id="magneticisland" title="magneticisland" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Magnetic Island</a>
            
            <a href="javascript:void(0);" class="map-point" id="ayr" title="ayr" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Ayr</a>
            
            <a href="javascript:void(0);" class="map-point" id="airliebeach" title="airliebeach" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Airlie Beach</a>
            
            <a href="javascript:void(0);" class="map-point" id="whitsundays" title="whitsundays" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Whitsundays</a>
            
            <!--<a href="<?php echo FRONTEND_URL;?>queensland/whitsundays/" class="map-point" id="townof1770" title="townof1770" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Town of 1770</a>-->
            
            <a href="javascript:void(0);" class="map-point" id="rockhampton" title="rockhampton" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Rockhampton</a>
            
            <a href="javascript:void(0);" class="map-point" id="bundaberg" title="bundaberg" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Bundaberg</a>
            
            <a href="javascript:void(0);" class="map-point" id="herveybay" title="herveybay" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Hervey Bay</a>
            
            <a href="javascript:void(0);" class="map-point" id="rainbowbeach" title="rainbowbeach" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Rainbow Beach</a>
            
            <a href="javascript:void(0);" class="map-point" id="fraserisland" title="fraserisland" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Fraser Island</a>
            
            <a href="javascript:void(0);" class="map-point" id="noosa" title="noosa" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Noosa</a>
            
            <a href="javascript:void(0);" class="map-point" id="brisbane" title="brisbane" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Brisbane</a>
            
            <a href="javascript:void(0);" class="map-point" id="goldcoast" title="goldcoast" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Gold Coast</a>
            
            <a href="javascript:void(0);" class="map-point" id="westernaustralia" title="westernaustralia" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Western Australia</a>
            
            <a href="javascript:void(0);" class="map-point" id="broome" title="broome" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Broome</a>
            
            <a href="javascript:void(0);" class="map-point" id="exmouth" title="exmouth" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Exmouth</a>
            
            <a href="javascript:void(0);" class="map-point" id="monkeymia" title="monkeymia" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Monkey Mia</a>
            
            <a href="javascript:void(0);" class="map-point" id="perth" title="perth" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Perth</a>
            
            <a href="javascript:void(0);" class="map-point" id="rottnestisland" title="rottnestisland" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Rottnest Island </a>
            
            <a href="javascript:void(0);" class="map-point" id="victoria" title="victoria" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Victoria</a>
            
            <a href="javascript:void(0);" class="map-point" id="phillipisland" title="phillipisland" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Phillip Island </a>
            
            <a href="javascript:void(0);" class="map-point" id="melbourne" title="melbourne" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Melbourne</a>
            
            <a href="javascript:void(0);" class="map-point" id="greatoceanroad" title="greatoceanroad" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Great Ocean Road</a>
            
            <a href="javascript:void(0);" class="map-point" id="newsouthwales" title="newsouthwales" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> New South Wales </a>
            
            <a href="javascript:void(0);" class="map-point" id="byronbay" title="byronbay" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Byron Bay</a>
            
            <!--<a href="<?php echo FRONTEND_URL;?>new-south-wales/byron-bay/" class="map-point" id="spotx" title="spotx" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Spot X</a>-->
            
            <a href="javascript:void(0);" class="map-point" id="coffsharbour" title="coffsharbour" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Coffs Harbour</a>
            
            <a href="javascript:void(0);" class="map-point" id="sydney" title="sydney" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Sydney</a>
            
            <a href="javascript:void(0);" class="map-point" id="bluemountains" title="bluemountains" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Blue Mountains</a>
            
            <a href="javascript:void(0);" class="map-point" id="southaustralia" title="southaustralia" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> South Australia</a>
            
            
            <a href="javascript:void(0);" class="map-point" id="adelaide" title="adelaide" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Adelaide</a>
            
            <a href="javascript:void(0);" class="map-point" id="portlincoln" title="portlincoln" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Port Lincoln</a>
            
            <a href="javascript:void(0);" class="map-point" id="cooberpedy" title="cooberpedy" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Coober Pedy</a>
            
            <a href="javascript:void(0);" class="map-point" id="kangarooisland" title="kangarooisland" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Kangaroo Island</a>
            
            <a href="javascript:void(0);" class="map-point" id="australiancaptialterritory" title="australiancaptialterritory" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Australian Captial Territory</a>
            
            <a href="javascript:void(0);" class="map-point" id="canberra" title="canberra" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Canberra</a>
            
            <a href="javascript:void(0);" class="map-point" id="tasmania" title="tasmania" data-ng-click="setPoniter($event)" ><i class="fa fa-map-marker"></i> Tasmania</a>
        
         </div>
        <div class="map-content"><img class="map" src="images/map.jpg" /></div>
        
      </div>
    </div>
          

        </div>

    </div>
    <!-- /.row -->
</div>
