
create table personas(
id int primary key identity(1,1),
cui nvarchar(13) null,
nombresCompletos nvarchar(200) not null,
apellidosCompletos nvarchar(200) not null,
fechaNacimiento nvarchar(50) null,
direccion nvarchar(200) null,
nombresPadre nvarchar(200) null,
nombresMadre nvarchar(200) null,
correoElectronico nvarchar(200) null,
estado int
)
go

ALTER PROCEDURE crud_registroPacientes
@id int = null,
@cui nvarchar(13) = null,
@nombresCompletos nvarchar(200) = null,
@apellidosCompletos nvarchar(200) = null,
@fechaNacimiento nvarchar(50) = null,
@direccion nvarchar(200) = null,
@nombresPadre nvarchar(200) = null,
@nombresMadre nvarchar(200) = null,
@correoElectronico nvarchar(200) = null,
@estado int = null,
@opcion int
AS
BEGIN

	IF @opcion = 1
		BEGIN TRY

			BEGIN TRANSACTION
				
				INSERT INTO personas 
						(cui, nombresCompletos, apellidosCompletos, fechaNacimiento, direccion, nombresPadre, nombresMadre, correoElectronico, estado)
				VALUES (@cui, @nombresCompletos, @apellidosCompletos, @fechaNacimiento, @direccion, @nombresPadre, @nombresMadre, @correoElectronico, 1);

				COMMIT TRANSACTION

				SELECT @@idENTITY;

		END TRY  
        BEGIN CATCH
            ROLLBACK TRANSACTION
                SELECT
                ERROR_NUMBER() AS ErrorNumber,
                ERROR_STATE() AS ErrorState,
                ERROR_SEVERITY() AS ErrorSeverity,
                ERROR_PROCEDURE() AS ErrorProcedure,
                ERROR_LINE() AS ErrorLine,
                ERROR_MESSAGE() AS ErrorMessage
        END CATCH

	IF @opcion = 2
		BEGIN TRY

			BEGIN TRANSACTION

				UPDATE personas SET 
									cui = @cui, 
									nombresCompletos = @nombresCompletos, 
									apellidosCompletos = @apellidosCompletos, 
									fechaNacimiento = @fechaNacimiento, 
									direccion = @direccion,
									nombresPadre = @nombresPadre ,
									nombresMadre = @nombresMadre, 
									correoElectronico = @correoElectronico
									WHERE id = @id

				COMMIT TRANSACTION

				SELECT @@idENTITY;

		END TRY  
		BEGIN CATCH
			ROLLBACK TRANSACTION
				SELECT
				ERROR_NUMBER() AS ErrorNumber,
				ERROR_STATE() AS ErrorState,
				ERROR_SEVERITY() AS ErrorSeverity,
				ERROR_PROCEDURE() AS ErrorProcedure,
				ERROR_LINE() AS ErrorLine,
				ERROR_MESSAGE() AS ErrorMessage
		END CATCH

	IF @opcion = 3
		BEGIN TRY

			BEGIN TRANSACTION

				UPDATE personas SET 
										estado = @estado
									WHERE id = @id

				COMMIT TRANSACTION

				SELECT @@idENTITY;

		END TRY  
		BEGIN CATCH
		
			ROLLBACK TRANSACTION
			SELECT
				ERROR_NUMBER() AS ErrorNumber,
				ERROR_STATE() AS ErrorState,
				ERROR_SEVERITY() AS ErrorSeverity,
				ERROR_PROCEDURE() AS ErrorProcedure,
				ERROR_LINE() AS ErrorLine,
				ERROR_MESSAGE() AS ErrorMessage
		END CATCH

	IF @opcion = 4
		BEGIN

			SELECT
				id,
				cui,
				nombresCompletos, 
				apellidosCompletos, 
				fechaNacimiento, 
				direccion, 
				nombresPadre, 
				nombresMadre, 
				correoElectronico,
				estado
			FROM personas 
				
			END

	IF @opcion = 5
		BEGIN TRY

			BEGIN TRANSACTION

				
				SELECT
					cui,
					nombresCompletos, 
					apellidosCompletos, 
					fechaNacimiento, 
					direccion, 
					nombresPadre, 
					nombresMadre, 
					correoElectronico,
					estado
				FROM personas 
				WHERE id = @id

				COMMIT TRANSACTION

		END TRY  
        BEGIN CATCH
            ROLLBACK TRANSACTION
                SELECT
                ERROR_NUMBER() AS ErrorNumber,
                ERROR_STATE() AS ErrorState,
                ERROR_SEVERITY() AS ErrorSeverity,
                ERROR_PROCEDURE() AS ErrorProcedure,
                ERROR_LINE() AS ErrorLine,
                ERROR_MESSAGE() AS ErrorMessage;
        END CATCH;


END
