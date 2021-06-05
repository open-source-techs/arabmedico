<?php
include 'header.php';
?>
<div id="breadcrumb" class="division">
	<div class="container">
		<div class="row">						
			<div class="col">
				<div class=" breadcrumb-holder">
					<nav aria-label="breadcrumb">
					  	<ol class="breadcrumb">
					    	<li class="breadcrumb-item"><a href="<?= base_url()."home".$pram;?>">Home</a></li>
					    	<li class="breadcrumb-item active" aria-current="page">Detail</li>
					  	</ol>
					</nav>
					<h4 class="h4-sm steelblue-color">Detail</h4>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
    .text-detail
    {
        padding: 15px;
        background: #fff;
        border-radius: 12px;
        margin-bottom:30px;
    }
    .right-bar
    {
        background: #fff;
        padding: 15px;
        border-radius: 12px;
    }
    
    .side-bar-toggler {
        display: inline-flex;
        align-items:center;
        justify-content:space-between;
        width: 100%;
        padding: 8px 15px;
        background-color: #fff;
        font-weight: 400;
        font-size: 14px;
        box-shadow: 0px 1px 3px 0px rgba(0,0,0,0.3);
        border-radius: 5px;
        margin-bottom:10px;
        transition:.1s linear;
    }
    @media(min-width:992px)
    {
        .side-bar-toggler 
        {
            display:none !important;
        }
    }
    .side-bar-toggler:hover {
        background-color: #00a3c8;
        color: #fff!important;
    }
    .side-bar 
    {
        box-shadow: 0px 1px 3px 0px rgba(0,0,0,0.3);
        border-radius: 10px;
        overflow: hidden;
        margin-bottom:30px;
    }
    .side-bar ul li a {
        display: inline-block;
        width: 100%;
        padding: 8px 15px;
        background-color: #fff;
        font-weight: 400;
        font-size: 14px;
        transition:.15s linear;
    }
    .side-bar ul li ~ li {
        border-top: 1px solid #ddd;
    }
    .side-bar ul li a:hover {
        background-color: #00a3c8;
        color: #fff!important;
    }
    .btn-blue {
        background-color: #00a3c8;
        color: #fff!important;
        line-height: 30px;
        margin-top: 15px;
        margin-left: 10px;
        padding: 5px 15px 5px 15px;
        border-radius:7px;
        transition:.1s linear;
    }
    .btn-blue:hover {
        background-color: #0e8eab;
    }
    .advice{
        border-radius:15px;
        background-color:#eee;
        padding:30px 15px;
    }
    .advice p
    {
        font-weight:600;
    }
    .right-bar
    {
        overflow:hidden;
        padding-top:60px !important;
        position:relative;
    }
    .right-bar-header
    {
        position:absolute;
        left:0px;
        top:0px;
        padding:10px 15px;
        color:#fff;
        background:#004861;
        width:100%;
        border-radius:12px 12px 0px 0px;
    }
    .pod .img-holder {
        position: relative;
        height:50px;
        min-width:50px;
        overflow:hidden;
        border-radius:100%;
        margin-right:12px;
        padding-top:0px;
    }
    .pod ~ .pod
    {
        margin-top:15px;
        border-top:1px solid #ddd;
        padding-top:15px;
    }
    .pod .img-holder img{
        object-fit:cover;
    }
    .pod .text h6
    {
        font-size:16px;
    }
    .pod .text p
    {
        font-size:13px;
        margin:0px 0px 10px
    }
    .btn-blue.btn-sm
    {
        font-size:13px;
        padding:5px 10px;
        margin:0px !important;
        border-radius:3px;
    }
    .detail-holder
    {
      background-color: #00a3c8;  
    }
</style>
<section id="info-4" class="wide-100 info-section division detail-holder">
	<div class="container">
	    <div class="row">
	        <div class="col-xl-3 col-lg-4 col-12">
	            <a href="#sideBar" data-toggle="collapse" class="side-bar-toggler">Active Link <i class="fa fa-angle-down"></i> </a>
                <div id="sideBar" class="collapse show">
            	    <div class="side-bar">
            	        <ul>
                            <li><a href="#">Anesthesiology</a></li>
                            <li><a href="#">Breast and Endocrine Surgery</a></li>
                            <li><a href="#">Cardiology</a></li>
                            <li><a href="#">Dermatology</a></li>
                            <li><a href="#">Ear, Nose &amp; Throat</a></li>
                            <li><a href="#">Extended Care</a></li>
                            <li><a href="#">Gastroenterology</a></li>
                            <li><a href="#">General Surgery</a></li>
                            <li><a href="#">Hematology</a></li>
                            <li><a href="#">Hepatobiliary Surgery</a></li>
                            <li><a href="#">Internal Medicine</a></li>
                            <li><a href="#">Nephrology</a></li>
                            <li><a href="#">Neurology</a></li>
                            <li><a href="#">Neurosurgery</a></li>
                            <li><a href="#">Obstetrics &amp; Gynecology</a></li>
                            <li><a href="#">Occupational Medicine</a></li>
                            <li><a href="#">Oncology</a></li>
                            <li><a href="#">Ophthalmology</a></li>
                            <li><a href="#">Oral &amp; Maxillofacial Surgery</a></li>
                            <li><a href="#">Orthopedic</a></li>
                            <li><a href="#">Pediatrics</a></li>
                            <li><a href="#">Plastic Surgery</a></li>
                            <li><a href="#">Psychiatry</a></li>
                            <li><a href="#">Radiology</a></li>
                            <li><a href="#">Reproductive Medicine</a></li>
                            <li><a href="#">Respiratory Medicine</a></li>
                            <li><a href="#">Rheumatology</a></li>
                            <li><a href="#">Upper Gastrointestinal Surgery</a></li>
                            <li><a href="#">Urology</a></li>
                        </ul>
            	    </div>
                </div>
	        </div>
	        <div class="col-xl-9 col-lg-8 col-12">
	            <div class="row">
    	            <div class="col-lg-8">
            	        <div class="text-detail">
                	        <h2>Extended Care</h2>
                	        <div class="img-holder">
                    	        <img src="https://www.slideteam.net/media/catalog/product/cache/960x720/o/u/our_vision_powerpoint_slide_deck_template_Slide01.jpg">
                    	    </div>
                    	    <p>Columbia Asia Hospital – Shah Alam, also known as the Columbia Asia Extended Care Hospital, is our long-term care healthcare facility with highly trained doctors, nurses and support staff whose priority is to make our patients stay and rehabilitation as comfortable as possible.</p>
                            <h6>Short & Long Term Care</h6>
                            <p>We provide nursing and rehabilitative services within a purpose-built and skilled nursing facility. Patients comprise of young adults and senior citizens who may be chronically ill, severely disabled, terminally ill or unable to live independently.</p>
                            <h6>House Calls by Resident Doctors</h6>
                            <p>Upon request, home visits by Resident Doctors can be arranged. These doctors are well-experienced in long-term care. They are able to carry out certain forms of treatment within the setting of patients’ homes. They are also able to provide advice regarding long-term care of homebound patients.</p>
                            <h6>Home Nursing</h6>
                            <p>State Registered Nurses are able to visit patients at their homes and carry out certain clinical procedures (such as urinary catheterization, change of nasogastric feeding tube and wound dressings).</p>
                	        <div class="advice text-center">
                	            <p class="mb-3">Need professional advice? Talk to our doctor or drop us your enquiries.</p>
                	            <button class="btn btn-blue">Ask a Question</button>
                	            <button class="btn btn-blue">Make an Appointemtn</button>
                	        </div>
                	    </div>
    	            </div>
    	            <div class="col-xl-4">
    	                <div class="right-bar">
    	                    <div class="right-bar-header">
    	                        Heading Title
    	                    </div>
    	                   <div class="pod d-flex align-items-start">
    	                       <div class="img-holder">
                        	        <img src="<?= base_url();?>images/person.JPG">
    	                       </div>
    	                       <div class="text">
    	                           <h6>Doctor Name Here</h6>
    	                           <p>Lorem Ipsum Dolor seit is a dummy text being used in this paragraph you can change it later</p>
    	                           <button class="btn btn-blue btn-sm">Button</button>
    	                       </div>
    	                   </div>
    	                   <div class="pod d-flex align-items-start">
    	                       <div class="img-holder">
                        	        <img src="<?= base_url();?>images/person.JPG">
    	                       </div>
    	                       <div class="text">
    	                           <h6>Doctor Name Here</h6>
    	                           <p>Lorem Ipsum Dolor seit is a dummy text being used in this paragraph you can change it later</p>
    	                           <button class="btn btn-blue btn-sm">Button</button>
    	                       </div>
    	                   </div>
    	                   <div class="pod d-flex align-items-start">
    	                       <div class="img-holder">
                        	        <img src="<?= base_url();?>images/person.JPG">
    	                       </div>
    	                       <div class="text">
    	                           <h6>Doctor Name Here</h6>
    	                           <p>Lorem Ipsum Dolor seit is a dummy text being used in this paragraph you can change it later</p>
    	                           <button class="btn btn-blue btn-sm">Button</button>
    	                       </div>
    	                   </div>
    	                </div>
    	            </div>
	            </div>
    	    </div>
	    </div>
	  
	</div>
</section>
<?php
include 'footer.php';
?>


<script>
    $(document).ready(function() {
        if ($(window).width() < 1005) {
            $( "#sideBar" ).removeClass('show');
        }
        else {
            $( "#sideBar" ).addClass('show');
        }
    });
    $( window ).resize(function() {
        if ($(window).width() < 1005) {
            $( "#sideBar" ).removeClass('show');
        }
        else {
            $( "#sideBar" ).addClass('show');
        }
    });
</script>
