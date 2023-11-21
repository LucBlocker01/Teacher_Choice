import React from "react";
import {Box, Chip, TableCell, TableRow, Tooltip} from "@mui/material";
import RemoveCircleIcon from "@mui/icons-material/RemoveCircle";
import AddCircleIcon from "@mui/icons-material/AddCircle";
import CancelIcon from "@mui/icons-material/Cancel";

function ChoiceItem({data}) {

    return (
        <TableRow>
            <TableCell component="th" scope="row">{data.lessonInformation.lesson.name}</TableCell>
            <TableCell align="center">{data.lessonInformation.lesson.subject.semester.name}</TableCell>
            <TableCell align="center">{data.lessonInformation.lesson.subject.name}</TableCell>
            <TableCell align="center">{data.lessonInformation.lessonType.name}</TableCell>
            <TableCell align="center">
                <Box sx={{ display: "flex", flexDirection: "row", alignItems: "center", justifyContent: "center"}}>
                    <Chip label={selectNb} variant="outlined" color="primary"/>
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
    )
}
export default ChoiceItem