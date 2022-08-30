import { Component } from '@angular/core';
import { EmpresaService } from './empresa.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'ApiBryRequest';
  constructor(private empresaService: EmpresaService)
  {}

  obterEmpresas(){
    this.empresaService.obterEmpresas()
    .then(empresas => console.log(empresas))
    .catch(error=>console.log(error));
  }
}
