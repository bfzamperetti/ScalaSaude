<style>

h1
{
	margin-left:25px;
	background-color:#49697A;
	padding:25px;
	margin:0;
	
	color:#FFF;	
}

.wrapper
{
	width:100%;
	height:100%;

}

.locaisTrabalho
{
	background-color:#FFF;
	float:left;
	width:50%;

}

.locaisTrabalho ul li
{
	margin-top:25px;
}

.subLocaisTrabalho
{

	background-color:#ECF0F1;
	float:right;
	width:50%;
	
}

.subLocaisTrabalho ul
{
	padding:25px;
}

.subLocaisTrabalho li
{
	list-style-type:none;	
}

.selecLocalTrabalho li
{
	
	margin-left:20px;
	margin-bottom:30px;
	list-style-type:none;
	background-color:#DEE0E0;
	
	height:50px;
	
}

.selecLocalTrabalho li:hover
{
	background-color:#BBBBBB;
}

.selecHospitais
{

}

.selecAtencao
{
	visibility:hidden;
}

.selecFarmaciaCom
{
	visibility:hidden;
}

.selecFarmaciaCom
{
	visibility:hidden;
}

.selecOutros
{
	visibility:hidden;
}

.nomeUnidade
{
	margin-left:25px;

}

</style>

<body>
	<div class="wrapper">
           <div class="locaisTrabalho">
            <h1>
                Adicionar Local de Trabalho
            </h1>
        
                <form name="mudar">
                <ul class="selecLocalTrabalho">
        
                    <li><input type="radio"/>Hospitais</li>
                    <li><input type="radio" />Atenção Primária em Saúde</li>
                    <li><input type="radio" />Farmácia Comercial</li>
                    <li><input type="radio" />Outros</li>            
        
                </ul>
                
        </div>
        <div class="subLocaisTrabalho">
        	
 				<ul class="selecHospitais">
                   <li><input type="radio"/>Análises Clínicas</li>
                    <li><input type="radio" />Administração hospitalar</li>
                    <li><input type="radio" />Farmácia clínica</li>
                    <li><input type="radio" />Farmácia de dispensação</li>  
                    <li><input type="radio" />Farmacoepidemiologia</li>
                    <li><input type="radio" />Fracionamento de medicamentos</li>
                    <li><input type="radio" />Hospital dia</li>
                </ul>
 				<ul class="selecAtencao">
                
                   <li><input type="radio"/>Administração farmacêutica</li>
                    <li><input type="radio" />Análises Clínicas</li>
                    <li><input type="radio" />Assistência domiciliar em equipes multidisciplinares</li>
                    <li><input type="radio" />Atendimento pré-hospitalar de urgência e emergência</li>  
                    <li><input type="radio" />Farmacêutico do Núcleo de Apoio em Saúde da Família</li>
                    <li><input type="radio" />Farmácia Clínica</li>
                    <li><input type="radio" />Farmácia de dispensação</li>
                    <li><input type="radio" />Farmacoepidemiologia</li>
                    <li><input type="radio" />Fracionamento de medicamentos</li>
					<li><input type="radio" />Meio ambiente, segurança no trabalho, saúde ocupacional e responsabilidade social</li>
					<li><input type="radio" />Vigilância Sanitária</li>
                    
                </ul>  
 				<ul class="selecFarmaciaCom">
                
                   <li><input type="radio"/>Farmácia Magistral</li>
                    <li><input type="radio" />Farmácia de dispensação</li>
                    <li><input type="radio" />Farmácia Popular</li>
                    <li><input type="radio" />Farmácia Clínica</li>  
                    <li><input type="radio" />Fracionamento de medicamentos</li>

                    
                </ul>                  
  				<ul class="selecOutros">
                
                    <li><input type="radio"/>Indústria Farmacêutica</li>
                    <li><input type="radio" />Laboratório de Análises Clínicas</li>
                    <li><input type="radio" />Professor Universitário</li>
                   
                </ul>
                                                                    
 
        </div>

        	<div class="nomeUnidade">
              	<h3>Digite o nome da unidade:</h3>
            	   	<input type="text">
               		<input type="submit">  
            </div>
	 </form>
	</div>    
</body>




<!--
Hospitais
Outros
Atenção Primária em Saúde (APS)
Farmácia Comercial
teste
Análises Clínicas
Administração hospitalar
Farmácia clínica
Farmácia de dispensação
Farmacoepidemiologia
Fracionamento de medicamentos
Hospital dia
Digite o nome de sua unidade:  -->


