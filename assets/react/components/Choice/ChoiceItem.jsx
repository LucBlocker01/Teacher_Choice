import React, {useEffect, useState} from "react";
import {
    Box,
    Button, Dialog, DialogActions, DialogContent, DialogContentText, DialogTitle,
    TableCell,
    TableRow, TextField
} from "@mui/material";
import {deleteChoiceById, modifyChoiceById} from "../../services/api/api";
import CancelIcon from '@mui/icons-material/Cancel';

function ChoiceItem({ data }) {
    // data -> id, nbGroupSelected, year, lessonInformation

    const [openDelete, setOpenDelete] = React.useState(false);

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

    const handleEdit = () => {
        var nbGroups = document.getElementById(data.id).value;
        const nbGroupsMax = data.lessonInformation.nbGroups;
        if (nbGroups <= nbGroupsMax && nbGroups >= 0) {
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

            <TableRow>
                <TableCell component="th" scope="row">{data.lessonInformation.lesson.name}</TableCell>
                <TableCell align="right">{data.lessonInformation.lesson.subject.semester.name}</TableCell>
                <TableCell align="right">{data.lessonInformation.lesson.subject.name}</TableCell>
                <TableCell align="right">
                    <input
                        id={data.id}
                        onChange={handleEdit}
                        type="number"
                        min="0"
                        max={data.lessonInformation.nbGroups}
                        placeholder={data.nbGroupSelected}
                    />
                </TableCell>
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
                    <CancelIcon onClick={() => {
                        handleClickOpenDelete();
                    }} color="primary" sx={{ cursor: "pointer" }}/>
                </TableCell>
            </TableRow>
        </>
    );
}

export default ChoiceItem;