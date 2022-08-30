import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { API_PATH } from 'src/environments/environment';
import { IEmpresa } from './IEmpresas';

@Injectable({
  providedIn: 'root'
})
export class EmpresaService {

  constructor(private httpClient: HttpClient) { }

  obterEmpresas(){
    return this.httpClient.get<IEmpresa[]>(`${API_PATH}empresas`).toPromise();
  }
}
