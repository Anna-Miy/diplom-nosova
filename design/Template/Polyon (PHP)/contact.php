
        <?php include '_header.php' ?>
        
        <div id="content" class="two-third">
        
        
        
        
        
          <article class="entry">
          
            <header class="entry-header">
              <h2>Contact</h2>
            </header>
            
            <div class="entry-content">
              
              <p>
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
              </p>
              
              <h3>Drop us a line</h3>
              
              
              <!-- Form with .three-column-form class -->
                 
              <form id="contactform" class="three-column-form" method="post" action="contactform_mailer.php">
              	
              	<p class="one-third">
              	  <label for="subject">Subject</label><br/>
              	  <input id="subject" name="cf_subject" class="required" type="text" />
              	</p>
              	
              	<p class="one-third">
              	  <label for="name">Name</label><br/>
              	  <input id="name" name="cf_name" class="required" type="text" />
              	</p>
              	
              	<p class="one-third last">
              	  <label for="email">E-Mail</label><br/>
              	  <input id="email" name="email" class="required" type="text" />
              	</p>
              	
              	<div class="spacer"></div>
                
              	<textarea id="message" name="cf_message" class="required" cols="40" rows="8"></textarea>
              	
                <div class="message"></div>
              	
              	<p>
                	<span class="small spacer"></span>
          				<input type="submit" name="submit" value="Send Message" />
                  <span class="spinner"><span>Please wait...</span></span>
              	</p>
              	
              </form>
              
            </div>
            <!-- END .entry-content -->
          </article>
          
          
          
          
          
        </div>
        <!-- END #content -->
        
        <?php include '_sidebar_contact.php' ?>
        <?php include '_footer.php' ?>