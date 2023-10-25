import React, {useEffect, useState} from 'react'
import useGetMe from "../../hooks/useGetMe";
import {postChoice} from "../../services/api/choice";
import {Alert, Button, Container, Snackbar, TextField} from "@mui/material";

function LessonItem({data}) {

    const [user, setUser] = useState(useGetMe());
    //useState lié au snackbar
    const [open, setOpen] = useState(false);
    const [snackBarType, setSnackBarType] = useState("success");
    const [message, setMessage] = useState("Votre choix a bien été pris en compte");
    //useState lié a l'accordéon

    //User
    useEffect(() => {
        useGetMe().then((data) => {
            setUser(data);
        })
    }, [])
    const submitChoice = (event) => {
        event.preventDefault();
        console.log(event.target);
        const year = new Date().getFullYear().toString();
        const lessonInformation = data["@id"];
        const nbGroupSelectedTemp = event.target[0].value;
        const nbGroupSelected = parseInt(nbGroupSelectedTemp);
        const teacher = "/api/users/"+event.target[2].value;
        const dataPost = {
            teacher,
            lessonInformation,
            nbGroupSelected,
            year
        }
        console.log("dataPost"+dataPost);
        if (nbGroupSelected <= data.nbGroups && nbGroupSelected > 0) {
            postChoice(dataPost);
            setSnackBarType("success");
            setMessage("Votre choix a bien été pris en compte");
        } else {
            setSnackBarType("error");
            setMessage("Le nombre de groupe doit être compris entre 1 et "+data.nbGroups);
        }
        setOpen(true);
    }

    const handleClose = (event, reason) => {
        if (reason === 'clickaway') {
            return;
        }

        setOpen(false);
    };

  return (
    <Container sx={{margin: "5px", padding: "5px", border: "2px solid", borderColor: "primary.main", borderRadius: "5px"}}>
      {data.lessonType.name}
        {console.log(data)}
      <form onSubmit={submitChoice} style={{display: "flex"}}>
          <TextField
            id="nbGroupe"
            name="nbGroupe"
            label="Nombre de groupe |"
            type="number"
            InputLabelProps={{
                shrink: true,
            }}
            InputProps={{ inputProps: { min: 1, max: data.nbGroups } }}
          />
          <input name='userID' type='hidden' value={user.id} />
          <Button
              type="submit"
              label="Submit"
              primary={true}
              sx={{
                  border: 1,
                  backgroundColor: "secondary.main",
              }}
          >
                Valider
          </Button>
      </form>
        <Snackbar
            open={open}
            autoHideDuration={5000}
            anchorOrigin={{vertical: 'bottom', horizontal: 'right'} }
            onClose={handleClose}
        >
            <Alert severity={snackBarType} sx={{ width: '100%' }} onClose={handleClose}>
                {message}
            </Alert>
        </Snackbar>
      </Container>
  )
}

export default LessonItem