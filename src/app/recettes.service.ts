import { Injectable } from '@angular/core';
import { Recette } from './recette';
import { Observable, of } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { catchError, map, tap } from 'rxjs/operators';




const httpOptions = {
  headers: new HttpHeaders({
      'Access-Control-Allow-Origin': ['GET', 'POST', 'PUT', 'DELETE', 'PATCH']

  })
};

@Injectable({
  providedIn: 'root'
})



export class RecettesService {

  private handleError<T> (operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {

      // TODO: send the error to remote logging infrastructure
      console.error(error); // log to console instead

      // TODO: better job of transforming error for user consumption
      console.log(`${operation} failed: ${error.message}`);

      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }

  public baseUrl = 'http://127.0.0.1:8000';

  //
recette: any;


  constructor(private http: HttpClient) { }



  getrecette(): Observable<Recette[]> {
    return this.http.get<Recette[]>(this.baseUrl + '/findAllRecette').pipe(
      tap(_ => console.log('fetched Recettes')),
      catchError(this.handleError<Recette[]>('getRecettes', []))
    );

  }
  createRecettes(recette: Recette): Observable<any> {
    return this.http.post<Recette>(this.baseUrl + '/newRecettes', recette, httpOptions).pipe(
      tap((newRecette: Recette) => console.log(`added recette w/ id=${newRecette.id}`)),
      catchError(this.handleError<Recette>('create'))
    );
  }
 /* getRecetteByID(id: number): Observable<any> {
    return this.http.get<Recette>(this.baseUrl + ` /RecetteByID2/${id}`).pipe(
    tap(_ => console.log(`fetched recette w/ id=${id}`)),
    catchError(this.handleError<Recette>('getRecettes')
    ));
    }*/


    getRecetteByID(id)
  {
    return this.http.get(this.baseUrl + ` /RecetteByID2/${id}`);
    }

 updateRecette(id: number, recette: Recette): Observable<any> {
  return this.http.post<Recette>(this.baseUrl + `/editRecettes/${id}`, recette, httpOptions).pipe(
    tap(_ => console.log(`updated recette w/ id=${recette.id}`)),
    catchError(this.handleError<Recette>('update'))
  );
}

deleteRecette(recette: Recette | number): Observable<Recette> {
  const id = typeof recette === 'number' ? recette : recette.id;
  const url = this.baseUrl + `/deleteRecettes/${id}`;
  console.log(url);
  return this.http.delete<Recette>(url, httpOptions).pipe(
    tap(_ => console.log(`deleted Recette id=${id}`)),
    catchError(this.handleError<Recette>('delete'))
  );
}


getRecettesList(): Observable<any> {
  return this.http.get(`${this.baseUrl}`);
}


createrecet(recette:Recette, categ:string) {

return this.http.post<any>(this.baseUrl + '/api/AjoutRecette?categoryID='+categ, recette,httpOptions);
  }







  addNewReci(recette: Recette,  category: string) {
    return this.http.post<any>(`${this.baseUrl}/api/AjoutRecette?categoryID=` + category, recette);
  }





}



