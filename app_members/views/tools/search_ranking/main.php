<aside id="left-panel">

   <div class="login-info">
      <span>
         <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
         <span class="nav-hidden">
            Search Ranking
         </span>
      </span>
   </div>

   <nav>
      <ul>
         <li class="nav-hidden">
            <strong>Actions</strong>
         </li>
         <li class="active">
            <a href="<?= base_url(); ?>tools/search-ranking"><i class="fa fa-lg fa-fw fa-line-chart"></i> <span class="menu-item-parent">Search Ranking</span></a>
         </li>
        <!-- <li>
            <a href="<?= base_url(); ?>tools/search-ranking/tool-training"><i class="fa fa-lg fa-fw fa-graduation-cap "></i> <span class="menu-item-parent">Tool Training</span></a>
         </li> -->
         <?php $this->load->view('quick_links'); ?>
      </ul>
   </nav>

   <span class="minifyme" data-action="minifyMenu">
      <i class="fa fa-arrow-circle-left hit"></i>
   </span>

</aside>


<div id="main" role="main">

   <div id="ribbon">
      <ol class="breadcrumb">
         <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i></a></li>
         <li><a href="<?= base_url(); ?>tools">Tools</a></li>
         <li>Search Ranking</li>
      </ol>
   </div>

   <div id="content">

      <section id="widget-grid" class="">

         <div class="row">
            <article class="col-md-4 col-md-push-8">
               <div class="jarviswidget well" id="wdj-grc-intro" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">

                  <div>
                     <div class="widget-body">

                  <form id="process-form">

                     <div class="form-group">
                        <label for="search_term"><strong>Search Term</strong></label>
                        <input id="search_term" name="search_term" class="form-control" type="text" placeholder="Search term">
                     </div>

                     <div class="form-group">
                        <label for="fiverr_username"><strong>Fiverr Username</strong></label>
                        <input id="fiverr_username" name="fiverr_username" class="form-control" type="text" placeholder="Fiverr username">
                     </div>

                     <div class="form-group">
                        <label for="filter"><strong>(Filter) Check in?</strong></label>
                        <div class="radio">
                           <label>
                              <input type="radio" name="filter" id="filter1" value="rating" checked> High Ratings Section
                           </label>
                        </div>
                        <div class="radio">
                           <label>
                              <input type="radio" name="filter" id="filter2" value="auto"> Recommended Section
                           </label>
                        </div>
                        <div class="radio">
                           <label>
                              <input type="radio" name="filter" id="filter3" value="new"> New Section
                           </label>
                        </div>
                     </div>

                     <div class="form-group">
                        <div class="checkbox">
                           <label>
                              <input type="checkbox" id="search_by_cat" name="search_by_cat" value="active"> Check by Categories
                           </label>
                        </div>
                     </div>

                     <div id="cat_options_toggle">
                        <div class="form-group">
                           <label for="cat_id"><strong>Category</strong></label>
                           <select class="form-control" id="cat_id" name="cat_id">
                              <option selected="selected" disabled="disabled" value="">Select a Category</option>
                              <option value="3">Graphics & Design</option>
                              <option value="2">Online Marketing</option>
                              <option value="5">Writing & Translation</option>
                              <option value="20">Video & Animation</option>
                              <option value="12">Music & Audio</option>
                              <option value="10">Programming & Tech</option>
                              <option value="4">Advertising</option>
                              <option value="8">Business</option>
                              <option value="7">Lifestyle</option>
                              <option value="15">Gifts</option>
                              <option value="1">Fun & Bizarre</option>
                              <option value="11">Other</option>
                           </select>
                        </div>

                        <div id="sub-cat-toggle" class="form-group">
                           <label for="sub_cat_id"><strong>Sub-Category</strong></label>
                           <select class="form-control" id="sub_cat_id" name="sub_cat_id">
                              <option selected="selected" value="">Choose Sub-Category</option>
                           </select>
                        </div>
                     </div>

                     <br>
                     <button id="submit_btn" class="btn btn-primary btn-block" type="submit">Check</button>
                  </form>


                     </div>
                  </div>

               </div>
            </article>
            <article class="col-md-8 col-md-pull-4">
               <div class="jarviswidget" id="wdj-gr-chker" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">

                  <header>
                     <span class="widget-icon"> <i class="fa fa-line-chart"></i> </span>
                     <h2>Search Ranking</h2>
                  </header>

                  <div>
                     <div class="widget-body">

                        <h3 class="text-center">Use this tool to check where all of your gigs are ranking for a specific keyword; check by ratings, category or globally.</h3>
                        <hr class="dashed">
                        <div id="onload-content" class="text-center">
                        <!--   <p>
                              Need help getting started? watch the tool training video below.
                           </p>
                           <center>
                              <a href="<?= base_url(); ?>tools/search-ranking/tool-training">
                                 <img data-toggle="tooltip" data-placement="right" title="Click to watch the trianing video!" class="img-responsive img-thumbnail" src="<?= base_url(); ?>assets/img/training-video-thumb.png">
                              </a>
                           </center>-->
                        </div>
                        <div id="process_data_status" class="img-style"></div>
                        <center>
                           <div id="process-loader">
                              <img src="<?= base_url(); ?>assets/img/ajax-loader.gif">
                              <br>
                              <p class="text-muted">Please Wait... This might take some time!</p>
                           </div>
                        </center>

                     </div>
                  </div>

               </div>
            </article>
         </div>

      </section>

   </div>
</div>


<style type="text/css">
   #cat_options_toggle {
      display: none;
   }
   #sub-cat-toggle {
      display: block;
   }
</style>

<script language='javascript' type="text/javascript">
   $(document).ready(function(){

      // Toggle category section
      $('input[type="checkbox"]').click(function(){
         if($(this).attr("value")=="active"){
            $("#cat_options_toggle").toggle(700);
         }
      });

      // validate form input
      $('#process-form').formValidation({
         feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
         },
         fields: {
            search_term: {
               validators: {
                  notEmpty: {
                     message: 'A search term is required.'
                  }
               }
            },
            fiverr_username: {
               validators: {
                  notEmpty: {
                     message: 'Your fiverr username is required.'
                  }
               }
            }
         }
      })

      // on validation success submit via Ajax
      .on('success.form.fv', function(e) {
         e.preventDefault();
         $("#submit_btn").removeAttr("disabled");
         $("#submit_btn").removeClass("disabled");

         var cat_data = document.getElementById("cat_id");
         var cat = cat_data.options[cat_data.selectedIndex].value;
         var sub_cat_data = document.getElementById("sub_cat_id");
         var sub_cat = sub_cat_data.options[sub_cat_data.selectedIndex].value;

         // If search by category is activated
         // Validate category input then submit data else submit data
         if($("#search_by_cat").is(":checked")) {
            if (cat == "") {
               swal({
                  title: "You did not select a Category!",
                  type: "warning",
                 confirmButtonColor: "#3276b1"
               });
            } else if (sub_cat == "") {
               swal({
                  title: "You did not select a Sub Category!",
                  type: "warning",
                 confirmButtonColor: "#3276b1"
               });
            } else {
               var dataString = $("#process-form").serialize();
               $.ajax({
                  url : '<?= base_url(); ?>tools/search_ranking/process_data',
                  type: "POST",
                  data : dataString,

                  beforeSend: function(){
                     $('#process-loader').fadeIn('slow');
                     $('#process_data_status').fadeOut(700);
                     $('#onload-content').fadeOut(700);
                  },
                  success:function(response) {
                     $('#process_data_status').fadeIn(700);
                     $('#process_data_status').html(response);
                  },
                  complete: function(){
                     $('#process-loader').fadeOut('slow');
                  }
               });
            }
         } else {
            var dataString = $("#process-form").serialize();
            $.ajax({
               url : '<?= base_url(); ?>tools/search_ranking/process_data',
               type: "POST",
               data : dataString,

               beforeSend: function(){
                  $('#process-loader').fadeIn('slow');
                  $('#process_data_status').fadeOut(700);
                  $('#onload-content').fadeOut(700);
               },
               success:function(response) {
                  $('#process_data_status').fadeIn(700);
                  $('#process_data_status').html(response);
               },
               complete: function(){
                  $('#process-loader').fadeOut('slow');
               }
            });
         }
      });

      // Add the sub category selection based on the main category
      var graphic_design = '<option selected="selected" value="" disabled="disabled">Select a Sub Category</option><option value="48">Cartoons & Caricatures</option><option value="49">Logo Design</option><option value="50">Illustration</option><option value="51">Book Covers & Packages</option><option value="53">Photoshop Editing</option><option value="55">Flyers & Posters</option><option value="56">Business Cards & Stationery</option><option value="148">Banner Ads</option><option value="149">Social Media Design</option><option value="150">3D & 2D Models</option><option value="151">Web & Mobile Design</option><option value="152">Presentations & Infographics</option><option value="153">Invitations</option><option value="154">T-Shirts</option><option value="155">Vector Tracing</option><option value="122">Other</option>';
      var online_marketing = '<option selected="selected" value="" disabled="disabled">Select a Sub Category</option><option value="59">Web Analytics</option><option value="60">Article & PR Submission</option><option value="61">Blog Mentions</option><option value="62">Domain Research</option><option value="63">Fan Pages</option><option value="64">Keywords Research</option><option value="65">SEO</option><option value="66">Bookmarking & Links</option><option value="67">Social Marketing</option><option value="68">Get Traffic</option><option value="69">Video Marketing</option><option value="120">Other</option>';
      var writing_translation = '<option selected="selected" value="" disabled="disabled">Select a Sub Category</option><option value="105">Copywriting</option><option value="106">SEO Keyword Optimization</option><option value="107">Creative Writing & Scripting</option><option value="108">Translation</option><option value="109">Transcripts</option><option value="110">Website Content</option><option value="111">Reviews</option><option value="112">Resumes & Cover Letters</option><option value="113">Speech Writing</option><option value="114">Proofreading & Editing</option><option value="115">Press Releases</option><option value="121">Other</option>';
      var video_animation = '<option selected="selected" value="" disabled="disabled">Select a Sub Category</option><option value="98">Commercials</option><option value="99">Editing & Post Production</option><option value="100">Animation & 3D</option><option value="101">Testimonials & Reviews by Actors</option><option value="102">Puppets</option><option value="103">Stop Motion</option><option value="104">Intros</option><option value="117">Other</option>';
      var music_audio = '<option selected="selected" value="" disabled="disabled">Select a Sub Category</option><option value="10">Mixing & Mastering</option><option value="11">Jingles & Drops</option><option value="16">Voice-overs</option><option value="17">Sound Effects</option><option value="156">Session Musicians</option><option value="157">Producers & Composers</option><option value="158">Singers & Songwriters</option><option value="20">Other</option>';
      var programming_tech = '<option selected="selected" value="" disabled="disabled">Select a Sub Category</option><option value="91">WordPress</option><option value="140">Web Programming</option><option value="141">Mobile Apps & Web</option><option value="138">Website Builders & CMS</option><option value="147">Convert Files</option><option value="139">Ecommerce</option><option value="144">User Testing</option><option value="145">QA</option><option value="87">Databases</option><option value="142">Desktop applications</option><option value="143">Data Analysis & Reports</option><option value="146">Support & IT</option><option value="97">Other</option>';
      var advertising = '<option selected="selected" value="" disabled="disabled">Select a Sub Category</option><option value="1">Hold Your Sign</option><option value="2">Flyers & Handouts</option><option value="3">Human Billboards</option><option value="4">Pet Models</option><option value="5">Outdoor Advertising</option><option value="6">Radio</option><option value="7">Music Promotion</option><option value="8">Banner Advertising</option><option value="9">Other</option>';
      var business = '<option selected="selected" value="" disabled="disabled">Select a Sub Category</option><option value="21">Business Plans</option><option value="22">Career Advice</option><option value="23">Market Research</option><option value="24">Presentations</option><option value="25">Virtual Assistant</option><option value="26">Business Tips</option><option value="27">Branding Services</option><option value="28">Financial Consulting</option><option value="30">Legal Consulting</option><option value="31">Other</option>';
      var lifestyle = '<option selected="selected" value="" disabled="disabled">Select a Sub Category</option><option value="72">Animal Care & Pets</option><option value="73">Relationship Advice</option><option value="74">Diet & Weight Loss</option><option value="75">Health & Fitness</option><option value="76">Makeup, Styling & Beauty</option><option value="77">Online Private Lessons</option><option value="78">Astrology & Fortune Telling</option><option value="79">Spiritual & Healing</option><option value="81">Cooking Recipes</option><option value="82">Parenting Tips</option><option value="127">Travel</option><option value="123">Other</option>';
      var gifts = '<option selected="selected" value="" disabled="disabled">Select a Sub Category</option><option value="40">Greeting Cards</option><option value="41">Video Greetings</option><option value="42">Unusual Gifts</option><option value="43">Arts & Crafts</option><option value="44">Handmade Jewelry</option><option value="45">Gifts for Geeks</option><option value="46">Postcards From...</option><option value="47">Recycled Crafts</option><option value="118">Other</option>';
      var fun_bizarre = '<option selected="selected" value="" disabled="disabled">Select a Sub Category</option><option value="32">Your Message On...</option><option value="33">Extremely Bizarre</option><option value="34">Celebrity Impersonators</option><option value="35">Daredevils & Stunts</option><option value="36">Pranks</option><option value="124">Dancers</option><option value="125">Just for Fun</option><option value="38">Other</option>';

      $("select#cat_id").on('change',function(){
         if($(this).val() == "3"){
            $("select#sub_cat_id").html(graphic_design);
         } else if($(this).val() == "2"){
            $("select#sub_cat_id").html(online_marketing);
         } else if($(this).val() == "5"){
            $("select#sub_cat_id").html(writing_translation);
         } else if($(this).val() == "20"){
            $("select#sub_cat_id").html(video_animation);
         } else if($(this).val() == "12"){
            $("select#sub_cat_id").html(music_audio);
         } else if($(this).val() == "10"){
            $("select#sub_cat_id").html(programming_tech);
         } else if($(this).val() == "4"){
            $("select#sub_cat_id").html(advertising);
         } else if($(this).val() == "8"){
            $("select#sub_cat_id").html(business);
         } else if($(this).val() == "7"){
            $("select#sub_cat_id").html(lifestyle);
         } else if($(this).val() == "15"){
            $("select#sub_cat_id").html(gifts);
         } else if($(this).val() == "1"){
            $("select#sub_cat_id").html(fun_bizarre);
         }

         // if the Other Option is selected hide the sub category selection
         if($(this).val() == "11"){
            $("#sub-cat-toggle").fadeOut('slow');
         } else {
            $("#sub-cat-toggle").show(700);
         }
      });

   });
</script>