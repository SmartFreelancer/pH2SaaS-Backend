<aside id="left-panel">

   <div class="login-info">
      <span>
         <img src="<?= base_url(); ?>assets/img/booster-icon.png" alt="Boosterr" class="img-circle" />
         <span class="nav-hidden">
            Earning Cal...
         </span>
      </span>
   </div>

   <nav>
      <ul>
         <li class="nav-hidden">
            <strong>Actions</strong>
         </li>
         <li class="active">
            <a href="<?= base_url('tools/earning-calculator'); ?>"><i class="fa fa-lg fa-fw fa-key"></i> <span class="menu-item-parent">Earning Calculator</span></a>
         </li>
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
         <li>Earning Calculator</li>
      </ol>
   </div>

   <div id="content">

      <section id="widget-grid">

         <div class="row">
            <article class="col-md-8">

               <div class="jarviswidget" id="ga-submit-gig" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                  <header>
                     <span class="widget-icon"> <i class="fa fa-key"></i> </span>
                     <h2>Earning Calculator - Set Your Goals</h2>
                  </header>
                  <div>
                     <div class="widget-body">

                        <form id="calcform" onsubmit="return false;">
                           <fieldset>
                              <div class="row">
                                 <div class="col-md-10 col-md-offset-1">
                                    <div class="form-group">
                                       <p>
                                          <label for="targetearning">Desire Net Monthly Income: $</label>
                                             <input type="number" name="targetearning" id="targetearning" required="required" onchange="calculateResult()" />
                                       </p>
                                       <p>
                                          <label for="sellingprice">Average Selling Price</label>
                                          <select id="sellingprice" name="sellingprice" onchange="calculateResult()">
                                              <option value="5">$5</option>
                                              <option value="10">$10</option>
                                              <option value="15">$15</option>
                                              <option value="20">$20</option>
                                              <option value="25">$25</option>
                                              <option value="30">$30</option>
                                              <option value="35">$35</option>
                                              <option value="40">$40</option>
                                              <option value="45">$45</option>
                                              <option value="50">$50</option>
                                              <option value="other">More...</option>
                                          </select>
                                       </p>
                                       <div id="otherBox" class="hidden">
                                          <label for="otherField" class="inlinelabel"><em>If more, please enter how much:</em></label>
                                          <input name="otherField" type="number" onchange="calculateResult()"/>
                                       </div>

                                      <hr>
                                      <p>
                                         <label for="ordersPerDay" class="inlinelabel">Approximate orders per day:</label><input type="text" disabled="disabled" id="ordersPerDay" />
                                      </p>
                                      <p>
                                       <label for="ordersPerMonth" class="inlinelabel">Number of orders needed per month:</label>
                                       <input type="text" disabled="disabled" id="ordersPerMonth" />
                                    </p>
                                    <p>
                                       <label for="yearlyEarning" class="inlinelabel">Yearly Earnings (USD):</label>
                                       <input type="text" disabled="disabled" id="yearlyEarning" />
                                    </p>
                                 </div>
                              </div>
                           </fieldset>
                        </form>

                     </div>
                  </div>

               </div>
            </article>
         </div>

      </section>

   </div>
</div>

<script>
var gig_prices = new Array();
    gig_prices[5]=3.92;
    gig_prices[10]=7.84;
    gig_prices[15]=11.76;
    gig_prices[20]=15.68;
    gig_prices[25]=19.6;
    gig_prices[30]=23.52;
    gig_prices[35]=27.44;
    gig_prices[40]=31.36;
    gig_prices[45]=35.28;
    gig_prices[50]=39.2;
    gig_prices["other"]=3.92;

function simplifyNums(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function calculateResult() {
    var ordersmnth = 0;
    var ordersday = 0;
    var annualearning = 0;
    var ordersmnthtemp = Math.ceil(targetEarnings()/getGigPrice());
    ordersmnth = simplifyNums(ordersmnthtemp);
    document.getElementById('ordersPerMonth').value = ordersmnth;
    ordersday = simplifyNums(Math.ceil(ordersmnthtemp / 30));
    document.getElementById('ordersPerDay').value = ordersday;
    annualearning = simplifyNums(targetEarnings() * 12);
    document.getElementById('yearlyEarning').value = '$' + annualearning;
}
function hideOtherPrice() {
    var divobj = document.getElementById('otherBox');
    divobj.style.display = 'none';
}
function targetEarnings() {
    var theForm = document.forms["calcform"];
    var quantity=theForm.elements["targetearning"];
    var earnings=0;
    if (quantity.value != "") {
      earnings = parseInt(quantity.value);
    }
    return earnings;
}
function getGigPrice() {
    var gigPrice=0;
    var theForm=document.forms["calcform"];
    var selectedPrice=theForm.elements["sellingprice"];
    var customPrice=theForm.elements["otherField"];
    if(selectedPrice.value=='other') {
      var divobj=document.getElementById('otherBox');
      divobj.className='';
      gigPrice=(customPrice.value/5)*3.92;
   } else {
      var divobj=document.getElementById('otherBox');
      divobj.className='hidden';
      gigPrice=gig_prices[selectedPrice.value];
   }
   return gigPrice;
}
   </script>
</script>