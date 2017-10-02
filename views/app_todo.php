        <!--start container-->
        <div class="container">
          <div class="section">
            <div class="col s12">
              <ul id="task-card" class="collection with-header">
                  <li class="collection-header cyan">
                      <h4 class="task-card-title">Tasks</h4>
                      <p class="task-card-date">Sept 20, 2017</p>
                  </li>
                  <a href="#task-modal" class="task-add modal-trigger btn-floating waves-effect waves-light"><i class="mdi-content-add"></i></a>
                  <li class="collection-item dismissable">
                      <input type="checkbox" id="task5" />
                      <label for="task5">Buy Materialize Admin Theme. <a href="#" class="secondary-content"><span class="ultra-small">Now</span></a>
                      </label>
                      <span class="task-cat teal">Work</span>
                  </li>
                  <li class="collection-item dismissable">
                      <input type="checkbox" id="task6" />
                      <label for="task6">Install Materialize Admin Theme. <a href="#" class="secondary-content"><span class="ultra-small">Today</span></a>
                      </label>
                      <span class="task-cat cyan">Webapp</span>
                  </li>
                  <li class="collection-item dismissable">
                      <input type="checkbox" id="task7" />
                      <label for="task7">Review and rate Materialize Admin Theme. <a href="#" class="secondary-content"><span class="ultra-small">Monday</span></a>
                      </label>
                      <span class="task-cat purple">Web API</span>
                  </li>
                  <li class="collection-item dismissable">
                      <input type="checkbox" id="task1" />
                      <label for="task1">Create Mobile App UI. <a href="#" class="secondary-content"><span class="ultra-small">Today</span></a>
                      </label>
                      <span class="task-cat teal">Mobile App</span>
                  </li>
                  <li class="collection-item dismissable">
                      <input type="checkbox" id="task2" />
                      <label for="task2">Check the new API standerds. <a href="#" class="secondary-content"><span class="ultra-small">Monday</span></a>
                      </label>
                      <span class="task-cat purple">Web API</span>
                  </li>
                  <li class="collection-item dismissable">
                      <input type="checkbox" id="task3" checked="checked" />
                      <label for="task3">Check the new Mockup of ABC. <a href="#" class="secondary-content"><span class="ultra-small">Wednesday</span></a>
                      </label>
                      <span class="task-cat pink">Mockup</span>
                  </li>
                  <li class="collection-item dismissable">
                      <input type="checkbox" id="task4" checked="checked" disabled="disabled" />
                      <label for="task4">I did it !</label>
                      <span class="task-cat cyan">Mobile App</span>
                  </li>
                  <li class="collection-item dismissable">
                      <input type="checkbox" id="task8" checked="checked" disabled="disabled" />
                      <label for="task8">I did this too !</label>
                      <span class="task-cat teal">Mobile App</span>
                  </li>
              </ul>

              <div id="task-modal" class="modal">
                <nav class="task-modal-nav red">
                    <div class="nav-wrapper">
                      <div class="left col s12 m5 l5">
                        <ul>
                          <li><a href="#!" class="todo-menu"><i class="modal-action modal-close  mdi-hardware-keyboard-backspace"></i></a>
                          </li>
                          <li><a href="#!" class="todo-add">Add</a>
                          </li>
                        </ul>
                      </div>
                      <div class="col s12 m7 l7 hide-on-med-and-down">
                        <ul class="right">
                          <li><a href="#!"><i class="mdi-editor-attach-file"></i></a>
                          </li>
                          <li><a href="#!"><i class="mdi-action-loyalty"></i></a>
                          </li>
                          <li><a href="#!"><i class="mdi-navigation-more-vert"></i></a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </nav>
                  <div class="modal-content">                    
                    <div class="row">
                      <form class="col s12">                        
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="todo-title" type="text" class="validate">
                            <label for="todo-title">Todo Title</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s6">                            
                            <select>
                              <option value="" disabled selected>Choose your option</option>
                              <option value="1">Design</option>
                              <option value="2">Develop</option>
                              <option value="3">Testing</option>
                            </select>
                          </div>                          
                          <div class="input-field col s6">
                            <div class="file-field input-field">
                              <input class="file-path validate" type="text" />
                              <div class="btn">
                                <span>File</span>
                                <input type="file" />
                              </div>
                            </div>
                            
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                              <textarea id="comments" class="materialize-textarea" length="500"></textarea>
                              <label for="comments">Comments</label>
                              <span class="character-counter"></span>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>                 
                </div>
          </div>
          </div>
        </div>
        <!--end container-->

    <!-- ================================================
    Scripts
-->