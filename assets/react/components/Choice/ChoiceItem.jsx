import React, {useEffect, useState} from "react";
import {
    Box,
    Button, Dialog, DialogActions, DialogContent, DialogContentText, DialogTitle,
    TableCell,
    TableRow, TextField
} from "@mui/material";
import {deleteChoiceById, modifyChoiceById} from "../../services/api/api";

function ChoiceItem({ data }) {
    // data -> id, nbGroupSelected, year, lessonInformation

    // OLD VERSION
    /*const [ lessonInformation, setLessonInformation ] = useState({}) ;
    const [ lesson, setLesson ] = useState({}) ;
    const [ subject, setSubject ] = useState({}) ;
    const [ type, setType ] = useState({}) ;
    console.log(lessonInformation);
    useEffect(() => {
        fetchByApiUrl(data.lessonInformation).then((dataInfo) => setLessonInformation(dataInfo))
    }, [data]);

    useEffect(() => {
        if (lessonInformation.lesson !== undefined) {
            fetchByApiUrl(lessonInformation.lesson).then((dataLesson) => setLesson(dataLesson))
        }
    }, [lessonInformation]);

    useEffect(() => {
        if (lesson.subject !== undefined) {
            fetchByApiUrl(lesson.subject).then((dataSubject) => setSubject(dataSubject))
        }
    }, [lesson]);

    useEffect(() => {
        if (lessonInformation.lessonType){
            fetchByApiUrl(lessonInformation.lessonType).then((dataType) => setType(dataType))
        }
    }, [lessonInformation]);*/

    const [openDelete, setOpenDelete] = React.useState(false);
    const [openEdit, setOpenEdit] = React.useState(false);

    const handleClickOpenDelete = () => {
        setOpenDelete(true);
    };

    const handleCloseDelete = () => {
        setOpenDelete(false);
    };

    const handleAcceptDelete = () => {
        setOpenDelete(false);
        deleteChoiceById(data.id).then();
        location.reload();
    };

    const handleClickOpenEdit = () => {
        setOpenEdit(true);
    };

    const handleCloseEdit = () => {
        setOpenEdit(false);
    };

    const handleAcceptEdit = () => {
        var nbGroups = document.getElementById('nbGroupSelected').value;
        const nbGroupsMax = data.lessonInformation.nbGroups;
        if (nbGroups <= nbGroupsMax && nbGroups >= 0) {
            setOpenEdit(false);
            modifyChoiceById(data.id, nbGroups).then();
            location.reload();
        } else {
           document.getElementById("alertEdit").innerHTML = "La saisie doit être entre 0 et "+nbGroupsMax+" pour être valide !!";
           setTimeout(()=>{
               document.getElementById("alertEdit").innerHTML = "";
           }, 3000);
        }
    };

    return (
        <>
            <Dialog open={openDelete} onClose={handleCloseDelete} aria-labelledby="alert-dialog-title" aria-describedby="alert-dialog-description">
                <DialogTitle id="alert-dialog-title">
                    {"Suppression"}
                </DialogTitle>
                <DialogContent>
                    <DialogContentText id="alert-dialog-description">
                        Supprimer ce voeux pour de bon ?
                    </DialogContentText>
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleCloseDelete}>Ne pas supprimer</Button>
                    <Button onClick={handleAcceptDelete} autoFocus>
                        Supprimer
                    </Button>
                </DialogActions>
            </Dialog>

            <Dialog open={openEdit} onClose={handleCloseEdit} aria-labelledby="alert-dialog-title" aria-describedby="alert-dialog-description">
                <DialogTitle id="alert-dialog-title">
                    {"Modification"}
                </DialogTitle>
                <DialogContent sx={{ textAlign: "center" }}>
                    <DialogContentText id="alert-dialog-description" sx={{ marginBottom: "5%" }}>
                        Placer ici le nouveau nombre de groupes a encadrer pour ce {data.lessonInformation.lessonType.name} de {data.lessonInformation.lesson.name}
                        <Box id="alertEdit" sx={{
                            color: "red"
                        }}></Box>
                    </DialogContentText>
                    <TextField
                        id="nbGroupSelected"
                        type="number"
                        autoFocus
                        fullWidth
                        value={data.nbGroupSelected}
                        InputLabelProps={{
                            shrink: true,
                        }}
                        InputProps={{ inputProps: { min: 0, max: data.lessonInformation.nbGroups } }}
                    />
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleCloseEdit}>Ne pas modifier</Button>
                    <Button onClick={handleAcceptEdit} autoFocus>
                        Modifier
                    </Button>
                </DialogActions>
            </Dialog>

            <TableRow>
                <TableCell component="th" scope="row">{data.lessonInformation.lesson.name}</TableCell>
                <TableCell align="right">{data.lessonInformation.lesson.subject.semester.name}</TableCell>
                <TableCell align="right">{data.lessonInformation.lesson.subject.name}</TableCell>
                <TableCell align="right">{data.nbGroupSelected}</TableCell>
                <TableCell align="right">{data.lessonInformation.nbGroups}</TableCell>
                <TableCell align="right">
                    <Box sx={{
                        margin: "1%",
                        backgroundColor: "accent.main",
                        color: "secondary.main",
                        borderRadius: "5px",
                        textAlign: "center"
                    }}>
                        {data.nbGroupAttributed ? data.nbGroupAttributed : 'non attribué'}
                    </Box>
                </TableCell>
                <TableCell align="right">{data.lessonInformation.lessonType.name}</TableCell>
                <TableCell>
                    <Button sx={{ border: 1 }} onClick={() => {
                        handleClickOpenEdit();
                    }} >Modifier</Button>
                </TableCell>
                <TableCell>
                    <Button sx={{ border: 1 }} onClick={() => {
                        handleClickOpenDelete();
                    }}>Supprimer</Button>
                </TableCell>
            </TableRow>
        </>
    );
}

export default ChoiceItem;