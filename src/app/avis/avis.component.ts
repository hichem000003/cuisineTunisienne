import { Component, OnInit } from '@angular/core';
import { AvisService } from '../avis.service';
import { Avi } from '../avi';
import { Observable, of } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';
@Component({
  selector: 'app-avis',
  templateUrl: './avis.component.html',
  styleUrls: ['./avis.component.css']
})
export class AvisComponent implements OnInit {

  avis:Avi[];
  avi:Avi;
  submitted = false;
    constructor(private avisService:AvisService,
      private router: Router) { }
  ngOnInit(): void {
    this.getAvis();
  }
  getAvis(): void {
    this.avisService.getavis()
        .subscribe(avis => {
          this.avis = avis;
          console.log('avis liste',this.avis);
        });
}
newAvi(): void {
this.submitted = false;
this.avi = new Avi;
}

save() {
this.avisService.createAvis(this.avi)
  .subscribe(data => console.log(data), error => console.log(error));
this.avi = new Avi();
//this.gotoList();
}

onSubmit() {
this.submitted = true;
this.save();
}

gotoList() {
this.router.navigate(['/avis']);
}
delete(avi:Avi): void {
this.avisService.deleteAvi(avi).subscribe(
  data => {
    console.log(data);
    this.getAvis();
  },
  error => console.log(error)
);
//window.location.replace('/books');
}



}
