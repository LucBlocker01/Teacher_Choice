import React, {useEffect, useState} from "react";
import {
    Box,
    Button, Dialog, DialogActions, DialogContent, DialogContentText, DialogTitle,
    TableCell,
    TableRow, TextField
} from "@mui/material";
import {deleteChoiceById, modifyChoiceById} from "../../services/api/api";
import CancelIcon from '@mui/icons-material/Cancel';
import AddCircleOutlineIcon from '@mui/icons-material/AddCircleOutline';
import RemoveCircleOutlineIcon from '@mui/icons-material/RemoveCircleOutline';

function ChoiceItem({ data }) {
    // data -> id, nbGroupSelected, year, lessonInformation

    const [openDelete, setOpenDelete] = React.useState(false);
    const [selectNb, setSelectNb] = React.useState(data.nbGroupSelected);

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

    const handlePlus = () => {
        setSelectNb(selectNb+1);
    }

    const handleMinus = () => {
        setSelectNb(selectNb-1);
    }

    useEffect(() => {
        modifyChoiceById(data.id, selectNb).then();
    }, [selectNb])

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
                <TableCell align="right">{data.lessonInformation.lessonType.name}</TableCell>
                <TableCell align="right" sx={{ display: "flex", flexDirection: "row", alignItems: "center"}}>
                    <Box>{selectNb}</Box>
                    <Box sx={{ display: "flex" }}>
                        <RemoveCircleOutlineIcon onClick={handleMinus}/>
                        <AddCircleOutlineIcon onClick={handlePlus}/>
                    </Box>
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