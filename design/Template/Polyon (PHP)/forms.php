
        <?php include '_header.php' ?>
        
        <div id="content" class="two-third">
        
        
        
        
          <article class="entry">
          
            <header class="entry-header">
              <h2>Form Styles</h2>
            </header>
            
            <div class="entry-content">
            
            
            
              
              <p>
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
              </p>




              <form method="post" action="#">
                
                <p>
                  <label for="f_text">Text</label><br/>
                  <input type="text" name="f_text" id="f_text" value="" size="36" />
                </p>
                
                <p>
                  <label for="f_password">Password</label><br/>
                  <input type="password" name="f_password" id="f_password" value="" size="36" />
                </p>
                
                <p>
                  <label for="f_textarea">Textarea</label><br/>
                  <textarea name="f_textarea" id="f_textarea" rows="9" cols="74"></textarea>
                </p>
                
                <p class="one-fourth">
            			<label>Radio Buttons:</label><br/>
            			
            			<input name="f_radiobuttons_1" type="radio" id="f_radio_1" value="radio_1" />
            			<label for="f_radio_1">Radio 1</label><br/>
            			
            			<input name="f_radiobuttons_1" type="radio" id="f_radio_2" value="radio_2" />
            			<label for="f_radio_2">Radio 2</label><br/>
            			
            			<input name="f_radiobuttons_1" type="radio" id="f_radio_3" value="radio_3" />
            			<label for="f_radio_3">Radio 3</label><br/>
          			</p>
          			
            		<p class="one-fourth">
            			<label>Checkboxes:</label><br/>
            			
            			<input type="checkbox" id="f_check_1" name="f_check_1" value="check_1" />
            			<label for="f_check_1">Check 1</label><br/>
            			
            			<input type="checkbox" id="f_check_2" name="f_check_2" value="check_2" />
            			<label for="f_check_2">Check 2</label><br/>
            			
            			<input type="checkbox" id="f_check_3" name="f_check_3" value="check_2" />
            			<label for="f_check_3">Check 3</label>
          			</p>
                
                <p class="two-fourth">
                  <label for="f_select">Select</label><br/>
                  <select name="f_select" id="f_select">
                    <option>This is an Option Element</option>
                    <option>This is an Option Element</option>
                    <option>This is an Option Element</option>
                    <option>This is an Option Element</option>
                    <option>This is an Option Element</option>
                  </select>
          			</p>
                
                <span class="divider"></span>
                
              	<p>
          				<input type="submit" name="submit" value="Submit" />
          				<input type="reset" name="reset" value="Reset" />
              	</p>
              	
              </form>
              
              
              
              
              <span class="spacer"></span>
              <span class="spacer"></span>
              
              
              

              <form method="post" action="#">
                
                <fieldset>
                  
                  <legend>Fieldset with Caption</legend>
                  
                  <p>
                    <label for="f2_text">Text</label><br/>
                    <input type="text" name="f2_text" id="f2_text" value="" size="36" />
                  </p>
                  
                  <p>
                    <label for="f2_password">Password</label><br/>
                    <input type="password" name="f2_password" id="f2_password" value="" size="36" />
                  </p>
                  
                  <p>
                    <label for="f2_textarea">Textarea</label><br/>
                    <textarea name="f2_textarea" id="f2_textarea" rows="9" cols="67"></textarea>
                  </p>
                  
                  <p class="one-fourth">
              			<label>Radio Buttons:</label><br/>
              			
              			<input name="f2_radiobuttons_1" type="radio" id="f2_radio_1" value="radio_1" />
              			<label for="f2_radio_1">Radio 1</label><br/>
              			
              			<input name="f2_radiobuttons_1" type="radio" id="f2_radio_2" value="radio_2" />
              			<label for="f2_radio_2">Radio 2</label><br/>
              			
              			<input name="f2_radiobuttons_1" type="radio" id="f2_radio_3" value="radio_3" />
              			<label for="f2_radio_3">Radio 3</label><br/>
            			</p>
            			
              		<p class="one-fourth">
              			<label>Checkboxes:</label><br/>
              			
              			<input type="checkbox" id="f2_check_1" name="f2_check_1" value="check_1" />
              			<label for="f2_check_1">Check 1</label><br/>
              			
              			<input type="checkbox" id="f2_check_2" name="f2_check_2" value="check_2" />
              			<label for="f2_check_2">Check 2</label><br/>
              			
              			<input type="checkbox" id="f2_check_3" name="f2_check_3" value="check_2" />
              			<label for="f2_check_3">Check 3</label>
            			</p>
                  
                  <p class="two-fourth last">
                    <label for="f2_select">Select</label><br/>
                    <select name="f2_select" id="f2_select">
                    <option>This is an Option Element</option>
                    <option>This is an Option Element</option>
                    <option>This is an Option Element</option>
                    <option>This is an Option Element</option>
                    <option>This is an Option Element</option>
                    </select>
            			</p>
                  
                  <span class="divider"></span>
                  
                	<p>
            				<input type="submit" name="submit" value="Submit" />
            				<input type="reset" name="reset" value="Reset" />
                	</p>
                	
                </fieldset>
              </form>
              
              
              
              
            </div>
            <!-- END .entry-content -->
          </article>
          
          
          
          
          
        </div>
        <!-- END #content -->
        
        <?php include '_sidebar.php' ?>
        <?php include '_footer.php' ?>