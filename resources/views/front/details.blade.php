@extends('front.master')
@section('content')
    <div class="container">
        <div class="wrapper">
            <div class="row">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><span class="dot">/</span><a href="#">Products</a></li>
                            <li><span class="dot">/</span><a href="#">Health Supplements</a></li>
                        </ul>
                    </div>
            </div>


                <div class="col-sm-5 col-md-5 col-lg-5">
                    <img src="{{asset('images')}}/{{$records->product_image}}" alt=""/>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-5">
                    <div class="prodInfo">
                        <h3>ADD {{$records->product_name}}</h3>
                        <div class="rating">
                            <div class="fk-stars">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p>Be the first to review this product : <a href="/">Write a Review</a></p>
                        </div>
                        <h2>EG {{$records->product_price}}</h2>
                        <div class="addbag">
                            <input type="text" value="0"/>
                            <div class="bagbtn"><a href="{{url('cart/add' , $records->id)}}">Add to bag</a></div>
                        </div>
                        <div class="wishlist">
                            <h3><strong><i class="fa fa-heart"></i></strong>
                                <hr>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid greyBg prodDes">
            <div class="container">
                <h4>Description</h4>
                <p>Worried about your low immunity level? We’ve got you covered.</p>
                <p>Our Add Energy Capsules cleanse your body, improve your vitality and boost your ability to fight all
                    types of illnesses. They tune up your body's well being and energy and prevent mild to serious
                    diseases. Add Energy Capsules enhance your body's ability to detoxify naturally.</p>
                <p>Add Energy is based on the idea to naturally nourish your body with lots of essential vitamins, micro
                    nutrients and proteins.</p>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="container top25">
            <ul class="nav nav-tabs responsive-tabs">
                <li class="active"><a href="#benefits">Benefits</a></li>
                <li><a href="#ingredient">Ingredients</a></li>
                <li><a href="#dosage">Dosages</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="benefits">
                    <ul>
                        <li>Greater resistance to health disorders like cancer, heart diseases, obesity, arthritis, high
                            blood pressure, high cholesterol and triglycerides (culprit in heart conditions)
                        </li>
                        <li>Better digestion and assimilation of nutrients</li>
                        <li>Increased mental alertness</li>
                        <li>Clearing up skin problems</li>
                        <li>Helps in quitting smoking and alcohol</li>
                        <li>Better resistance to allergies</li>
                        <li>Enhanced physical energy and activity</li>
                        <li>Helps with sinus congestion and recurrent respiratory problems</li>
                        <li>Removes constipation and fatigue</li>
                        <li>Completely Ayurvedic – which means no side effects.</li>
                    </ul>
                </div>
                <div class="tab-pane" id="ingredient">
                    <p><strong>Dosage:</strong> One capsule twice daily after meals with water/milk/juice.</p>
                    <p>Each 500mg Capsule Contains</p>
                    <div id="no-more-tables">
                        <table class="table-bordered table-striped table-condensed cf">
                            <tbody>
                            <tr>
                                <td data-title="Order No"><a href="#">Asparagus Racemosus (Satawari) </a></td>
                                <td data-title="item">50 mg</td>
                            </tr>
                            <tr>
                                <td data-title="Order No">Boerhavia Diffusa (Punarnava)</td>
                                <td data-title="item">50 mg</td>
                            </tr>
                            <tr>
                                <td data-title="Order No">Ocimum Sanctum (Tulsi)</td>
                                <td data-title="item">50 mg</td>
                            </tr>
                            <tr>
                                <td data-title="Order No">Withania Somnifera (Ashwagandha)</td>
                                <td data-title="item">50 mg</td>
                            </tr>
                            <tr>
                                <td data-title="Order No">Embilica Officinalis (Amla Dry)</td>
                                <td data-title="item">50 mg</td>
                            </tr>
                            <tr>
                                <td data-title="Order No">Piper nigrum (Kali Mirch)</td>
                                <td data-title="item">25 mg</td>
                            </tr>
                            <tr>
                                <td data-title="Order No">Ch Curchligo Orchiodes (Kali Musli)</td>
                                <td data-title="item">25 mg</td>
                            </tr>
                            <tr>
                                <td data-title="Order No">Terminalia Chebula (Harar)</td>
                                <td data-title="item">25 mg</td>
                            </tr>
                            <tr>
                                <td data-title="Order No">Plumbago Zeylanica (Chitrakmul)</td>
                                <td data-title="item">50 mg</td>
                            </tr>
                            <tr>
                                <td data-title="Order No">Piper Longum (Pippali)</td>
                                <td data-title="item">50 mg</td>
                            </tr>
                            <tr>
                                <td data-title="Order No">Ptychotis Ajowain (Ajowain) (Pippali)</td>
                                <td data-title="item">25 mg</td>
                            </tr>
                            <tr>
                                <td data-title="Order No">Asphatum (Shilajit)</td>
                                <td data-title="item">50 mg</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="dosage">
                    <p>You are in the pink of your health. You can give your 100% all day long. Your close ones are
                        experiencing life at its best. And everything is beautiful. At Addveda, we love to take you to
                        that dream world. Embracing the 6,000 year old Indian medical system Ayurveda, we focus on
                        holistic wellness through our all-natural medicines for gluten allergy, heart problems, skin
                        problems, sexual problems and everything that keeps you up at night.</p>
                </div>
            </div>
        </div>

    </div>

@endsection
