<?php
zabeleziStranicu('shop');
?>
<div class="container mt-5 prostor">
        <div class="row w-100 m-0">
            <div class="col-lg-3 p-2">
                <div class="row">
                    <div class="col-12">
                        <p class="font-weight-bold">Sortirajte po ceni:</p>
                        <select class="custom-select" id="sort">
                            <option value="asc">Rastuće</option>
                            <option value="desc">Opadajuće</option>
                        </select>
                        <br/><br/>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label for="pretraga">Pretraži</label>
                                <input type="text" id="search" name="search"/>
                            </li>
                        </ul>
                        <br/>
                        
                        <div class="row">
                            <div class="col-12">
                                <p class="font-weight-bold">Kategorije:</p>
                                <ul class="list-group" id="categories">
                                </ul>
                                <br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 py-2">
                <h1 id="count">Proizvodi</h1>
                <div class="row m-0 w-100" id="products">
                    
                </div>
            </div>
        </div>
    </div>