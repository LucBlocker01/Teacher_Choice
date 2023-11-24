import React from "react";
import {
    Box,
    Button, Chip, Dialog, DialogActions, DialogContent, DialogContentText, DialogTitle,
    TableCell,
    TableRow,
    Tooltip
} from "@mui/material";
import {deleteChoiceById, modifyChoiceById} from "../../services/api/api";
import CancelIcon from '@mui/icons-material/Cancel';
import AddCircleIcon from '@mui/icons-material/AddCircle';
import RemoveCircleIcon from '@mui/icons-material/RemoveCircle';


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
        if (selectNb+1 <= data.lessonInformation.nbGroups){
            setSelectNb(selectNb+1);
            changeValue();
        }
    }

    const handleMinus = () => {
        if (selectNb-1 >= 0){
            setSelectNb(selectNb-1);
            changeValue();
        }
    }

    const changeValue = () => {
        modifyChoiceById(data.id, selectNb).then();
    }

    return (
        <>
            <Dialog open={openDelete} onClose={handleCloseDelete} aria-labelledby="alert-dialog-title" aria-describedby="alert-dialog-description" PaperProps={{
               sx : {
                    backgroundColor : "secondary.main"
            }}}>
                <DialogTitle id="alert-dialog-title">
                    {"Suppression"}
                </DialogTitle>
                <DialogContent>
                    <DialogContentText id="alert-dialog-description">
                        Supprimer ce voeux pour de bon ?
                    </DialogContentText>
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleCloseDelete} >Ne pas supprimer</Button>
                    <Button onClick={handleAcceptDelete} autoFocus>
                        Supprimer
                    </Button>
                </DialogActions>
            </Dialog>

            <TableRow>
                <TableCell component="th" scope="row">{data.lessonInformation.lesson.name}</TableCell>
                <TableCell align="center">{data.lessonInformation.lesson.subject.semester.name}</TableCell>
                <TableCell align="center">{data.lessonInformation.lesson.subject.name}</TableCell>
                <TableCell align="center">{data.lessonInformation.lessonType.name}</TableCell>
                <TableCell align="center">
                    <Box sx={{ display: "flex", flexDirection: "row", alignItems: "center", justifyContent: "center"}}>
                        <Chip label={selectNb} variant="outlined" sx={{ color: "text.main", borderColor: "primary.main"}} />
                        <Box sx={{ display: "flex" }}>
                            <Tooltip title="minimum: 0"><RemoveCircleIcon onClick={handleMinus} color="primary" sx={{ cursor: "pointer" }}/></Tooltip>
                            <Tooltip title={"maximum: "+data.lessonInformation.nbGroups}><AddCircleIcon onClick={handlePlus} color="primary" sx={{ cursor: "pointer" }}/></Tooltip>
                        </Box>
                    </Box>
                </TableCell>
                <TableCell align="center">{data.lessonInformation.nbGroups}</TableCell>
                <TableCell align="center">
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