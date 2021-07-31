import { Component, OnInit } from '@angular/core';
import { RecettesService } from '../recettes.service';
import { Recette } from '../recette';
import { Observable, of } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup,FormControl,Validators } from '@angular/forms';

@Component({
  selector: 'app-add-recette',
  templateUrl: './add-recette.component.html',
  styleUrls: ['./add-recette.component.css']
})
export class AddRecetteComponent implements OnInit {
  form :FormGroup
  recette: any;
 constructor(private service: RecettesService, private router : Router, private formBuilder: FormBuilder) {}


 ngOnInit() {

  this.form=this.createForm();
 }

 /*createProvider(myform) {

  this.service.createrecet(myform).subscribe(
  response => {
  console.log(response);
  }
  );

  this.router.navigate(['addRecette']);
  }*/




  createForm(): FormGroup{
    return this.formBuilder.group({



      nomRecette : [null,[]],
      tempsCuisson: [null,[]],
      tempsPreparation: [null,[]],
      categories:[null,[]]




    })

 }

 Ajouter(){
   console.log("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"+this.form.get('categories').value)

  this.service.createrecet(this.form.value,this.form.get('categories').value).subscribe(data => {this.form.patchValue(data);
 });}
}
