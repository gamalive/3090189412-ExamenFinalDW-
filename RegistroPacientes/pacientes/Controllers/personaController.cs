using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Newtonsoft.Json.Linq;
using pacientes.Data;
using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Threading.Tasks;

namespace pacientes.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class personaController : ControllerBase
    {


        [HttpPost]
        [Route("createPerson")]
        public IActionResult createPerson(JObject request)
        {

            int newID;

            using (SqlConnection oConexion = new SqlConnection(Conexion.cadenaConexion))
            {
                SqlCommand cmd = new SqlCommand("crud_registroPacientes", oConexion);
                cmd.CommandType = CommandType.StoredProcedure;
                cmd.Parameters.AddWithValue("@opcion", 1);
                cmd.Parameters.AddWithValue("@cui", request.GetValue("cui").ToString());
                cmd.Parameters.AddWithValue("@nombresCompletos", request.GetValue("nombre").ToString());
                cmd.Parameters.AddWithValue("@apellidosCompletos", request.GetValue("apellido").ToString());
                cmd.Parameters.AddWithValue("@fechaNacimiento", request.GetValue("fechaNacimiento").ToString());
                cmd.Parameters.AddWithValue("@direccion", request.GetValue("direccion").ToString());
                cmd.Parameters.AddWithValue("@nombresPadre", request.GetValue("nameP").ToString());
                cmd.Parameters.AddWithValue("@nombresMadre", request.GetValue("nameM").ToString());
                cmd.Parameters.AddWithValue("@correoElectronico", request.GetValue("email").ToString());

                try
                {

                    oConexion.Open();


                    newID = Convert.ToInt32(cmd.ExecuteScalar());


                    return Ok(newID);

                }
                catch (Exception ex)
                {
                    return BadRequest(ex.ToString());
                }
            }
        }

        [HttpPost]
        [Route("updatePerson")]
        public IActionResult updatePerson(JObject request)
        {


            using (SqlConnection oConexion = new SqlConnection(Conexion.cadenaConexion))
            {
                SqlCommand cmd = new SqlCommand("crud_registroPacientes", oConexion);
                cmd.CommandType = CommandType.StoredProcedure;
                cmd.Parameters.AddWithValue("@opcion", 2);
                cmd.Parameters.AddWithValue("@id", request.GetValue("id").ToString());
                cmd.Parameters.AddWithValue("@cui", request.GetValue("cui").ToString());
                cmd.Parameters.AddWithValue("@nombresCompletos", request.GetValue("nombre").ToString());
                cmd.Parameters.AddWithValue("@apellidosCompletos", request.GetValue("apellido").ToString());
                cmd.Parameters.AddWithValue("@fechaNacimiento", request.GetValue("fechaNacimiento").ToString());
                cmd.Parameters.AddWithValue("@direccion", request.GetValue("direccion").ToString());
                cmd.Parameters.AddWithValue("@nombresPadre", request.GetValue("nameP").ToString());
                cmd.Parameters.AddWithValue("@nombresMadre", request.GetValue("nameM").ToString());
                cmd.Parameters.AddWithValue("@correoElectronico", request.GetValue("email").ToString());

                try
                {

                    oConexion.Open();
                    cmd.ExecuteNonQuery();


                    return Ok(true);

                }
                catch (Exception ex)
                {
                    return BadRequest(false);
                }
            }
        }

        [HttpPost]
        [Route("deletePerson")]
        public IActionResult deletePerson(JObject request)
        {

            using (SqlConnection oConexion = new SqlConnection(Conexion.cadenaConexion))
            {
                SqlCommand cmd = new SqlCommand("crud_registroPacientes", oConexion);
                cmd.CommandType = CommandType.StoredProcedure;
                cmd.Parameters.AddWithValue("@opcion", 3);
                cmd.Parameters.AddWithValue("@id", request.GetValue("id").ToString());
                cmd.Parameters.AddWithValue("@estado", request.GetValue("estado").ToString());

                try
                {

                    oConexion.Open();
                    cmd.ExecuteNonQuery();
                    return Ok(true);

                }
                catch (Exception ex)
                {
                    return BadRequest(false);
                }
            }
        }

        [HttpGet]
        [Route("getListPersons")]
        public IActionResult getListPersons()
        {

            using (SqlConnection oConexion = new SqlConnection(Conexion.cadenaConexion))
            {
                try
                {
                    oConexion.Open();

                }
                catch (Exception ex)
                {
                    return BadRequest("La conexion a fallado: \n" + ex.ToString());
                }

                SqlCommand cmd = new SqlCommand("crud_registroPacientes", oConexion);
                cmd.CommandType = CommandType.StoredProcedure;
                cmd.Parameters.AddWithValue("@opcion", 4);

                cmd.ExecuteNonQuery();
                SqlDataAdapter adapter = new SqlDataAdapter(cmd);
                DataSet setter = new DataSet();

                try
                {
                    adapter.Fill(setter, "paciente");

                    if (setter.Tables["paciente"] == null)
                    {
                        return BadRequest("La tabla esta vacía.");
                    }

                    if (setter.Tables["paciente"].Rows == null)
                    {
                        return BadRequest("La tabla no tiene filas asignadas.");
                    }

                    if (setter.Tables["paciente"].Rows.Count <= 0)
                    {
                        return BadRequest("La tabla esta vacía.");
                    }


                    return Ok(setter.Tables["paciente"]);

                }
                catch (Exception ex)
                {
                    return BadRequest(false);

                }
            }
        }


        [HttpPost]
        [Route("getPerson")]
        public IActionResult getPerson(JObject request)
        {

            using (SqlConnection oConexion = new SqlConnection(Conexion.cadenaConexion))
            {
                try
                {
                    oConexion.Open();

                }
                catch (Exception ex)
                {
                    return BadRequest("La conexion a fallado: \n" + ex.ToString());
                }

                SqlCommand cmd = new SqlCommand("crud_registroPacientes", oConexion);
                cmd.CommandType = CommandType.StoredProcedure;
                cmd.Parameters.AddWithValue("@opcion", 5);
                cmd.Parameters.AddWithValue("@id", request.GetValue("id").ToString());

                cmd.ExecuteNonQuery();
                SqlDataAdapter adapter = new SqlDataAdapter(cmd);
                DataSet setter = new DataSet();

                try
                {
                    adapter.Fill(setter, "paciente");

                    if (setter.Tables["paciente"] == null)
                    {
                        return BadRequest("La tabla esta vacía.");
                    }

                    if (setter.Tables["paciente"].Rows == null)
                    {
                        return BadRequest("La tabla no tiene filas asignadas.");
                    }

                    if (setter.Tables["paciente"].Rows.Count <= 0)
                    {
                        return BadRequest("La tabla esta vacía.");
                    }


                    return Ok(setter.Tables["paciente"]);

                }
                catch (Exception ex)
                {
                    return BadRequest(false);

                }
            }
        }


    }
}
