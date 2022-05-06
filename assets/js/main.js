$(document).ready(function(){
activeNav();
$.ajax({
  url:"models/product/getCategories.php",
  method:"get",
  dataType:"json",
  success:function(data){
    ispisKategorija(data);
  },
  error:function(xhr){
    console.error(xhr.responseText);
  }
})
$.ajax({
  url:"models/product/getProducts.php",
  method:"get",
  dataType:"json",
  success:function(data){
    ispisProizvoda(data);
  },
  error:function(xhr){
    console.error(xhr.responseText);
  }
})

$(document).on("click",".addToCart",addToCart);

$(document).on("change",".category",filterProizvoda);
$("#search").keyup(filterProizvoda);
$("#sort").on("change",filterProizvoda);

})


function ispisProizvoda(proizvodi){
  let html = "";
  $('#count').html("Proizvodi ("+proizvodi.length+")");
  if(proizvodi.length>0){
    for(proizvod of proizvodi){
      html+=`<div class="col-12 col-sm-6 col-md-4 mt-2">
      <div class="card">
          <img src="assets/img/${proizvod.slika}" class="card-img-top" alt="${proizvod.p_naziv}">
          <div class="card-body">
            <h5 class="card-title">${proizvod.p_naziv}</h5><hr/>
            <p class="card-text m-0">Kategorija: ${proizvod.k_naziv}</p><hr/>
            <p class="card-text font-weight-bold m-0">Cena: ${proizvod.cena},00 RSD</p>
            <a href="#!" class="btn btn-primary mt-2 addToCart" id=${proizvod.id}>Dodaj u korpu</a>
            <p></p>
          </div>
        </div>
      </div>`
    }
  }
  else{
    html=`<div class="container m-5 alert alert-danger"><p>Nema proizvoda koji odgovaraju vašoj pretrazi.</p></div>`
  }
  $('#products').html(html);
}

function ispisKategorija(kategorije){
  let html="";
  for(let kat of kategorije){
    html+=`<li class="list-group-item">
      <input type="checkbox" value="${kat.id_kategorija}" class="category" name="categories"/> ${kat.naziv_kat}
    </li>`
  }
  $("#categories").html(html);
}

function addToCart(){
  let id=this.id;
  let obj = $(this).next();
  $.ajax({
    url:"models/product/addToCart.php?id="+id,
    method:"get",
    success: function(response){
      poruka(obj,response);
    },
    error: function(xhr){
      console.error(xhr.responseText);
    }
  })
}

function filterProizvoda(){
  let searchVal = $("#search").val().toLowerCase();
  let sortVal = $("#sort").val();
  let izabraneKat=[];
  $('.category:checked').each(function(el){
    izabraneKat.push(parseInt($(this).val()));
  })
  $.ajax({
    url:"models/product/filterProducts.php",
    method:"post",
    dataType:"json",
    data:{
      catArr:JSON.stringify(izabraneKat),
      search:searchVal,
      sort:sortVal
    },
    success:function(response){
      ispisProizvoda(response);
    },
    error:function(xhr){
      console.log("greska");
    }

  })
}

//Dodavanje active klase nav linku u zavisnosti od stranice
function activeNav(){
    $page = document.URL.split("page=")[1];
        switch($page){
            case 'shop':
                $('.nav-link:contains("Prodavnica")').addClass('active');
                break;
            case 'cart':
                $('.nav-link:contains("Korpa")').addClass('active');
                break;
            case 'adminStats':
                $('.nav-link:contains("Statistika")').addClass('active');
                break;
            case 'adminProducts':
                $('.nav-link:contains("Proizvodi")').addClass('active');
                break;
            case 'adminUsers':
                $('.nav-link:contains("Korisnici")').addClass('active');
                break;
            case undefined:
                $('.nav-link:contains("Početna")').addClass('active');
                break;
        }
}
//Funkcija za ispis poruke da je proizvod dodat u korpu
function poruka(polje,tekst){
  switch(tekst){
    case 'success':
      polje.html("<i class='fas fa-check'></i>Uspešno dodato").addClass("text-success");
      break;
    case 'admin':
      polje.html("<i class='fas fa-times'></i>Admin ne može da dodaje u korpu.").addClass("text-danger");
      break;
    case 'login':
      polje.html("<i class='fas fa-times'></i></i>Morate biti ulogovani.").addClass("text-danger");
      break;
    case 'else':
      polje.html("<i class='fas fa-times'></i></i>Nepredviđena greška.").addClass("text-danger");
      break;
  }
  setTimeout(function(){polje.html("");},3000);
  clearTimeout();
}

//Funkcije za obradu forme
function ukloniGreske(){
    $('.greska').hide();
    $('.uspeh').hide();
  }
  function greskaForme(elementForme,poruka){
    $(elementForme).next().text(poruka).fadeIn();
  }
  var izrazMejl = /^([a-z]{3,15})(([\.]?[-]?[_]?[a-z]{3,20})*([\d]{1,3})*)@([a-z]{3,20})(\.[a-z]{2,3})+$/;
  
  $(document.regForm).on("submit",function(event){
    event.preventDefault();
    ukloniGreske();
    let forma=document.regForm;
    let greska=false;
    
    if(!izrazMejl.test(forma.tbEmail.value)){
        greskaForme(forma.tbEmail, "Unesite email u pravilnoj formi(primer: vaseime@gmail.com).")
        greska = true;
    }
    
    if(forma.tbPass.value.length < 7) {
        greskaForme(forma.tbPass, "Lozinka mora imati bar 7 karaktera.");
        greska = true;
    }
  
    if(!greska){
        $('#btnReg').attr('type','hidden');
        forma.submit();
    }
  })

  $(document.logForm).on("submit",function(event){
      event.preventDefault();
      ukloniGreske();
      let forma = document.logForm;
      let greska = false;
    console.log("desilo se")
      if(!forma.tbEmail.value){
        greskaForme(forma.tbEmail,"Email ne sme biti prazan.");
        greska=true;
      }
      if(!forma.tbPass.value){
        greskaForme(forma.tbPass,"Lozinka ne sme biti prazna.");
        greska=true
      }

      if(!greska){
          $('#btnLogin').attr('type','hidden');
          forma.submit();
      }
  })