funObtenerIdLista(
  List lista,
  String nombre
)
async{
  int id = 0;
  for(int cont = 0; cont < lista.length; cont++)
  {
    if(nombre == lista[cont]['name'])
    {
      id = await lista[cont]['id'];
    }
  }

  return id;
}