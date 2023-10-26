import React, {useState} from "react";
import {Button, TableCell, TableRow, TextField} from "@mui/material";
import {deleteChoiceById, PatchTeacherChoiceById} from "../../services/api/api";


function TeacherChoiceItem({ data }) {
    return (
        <TableRow>
            <TableCell component="th" scope="row">{data.lessonInformation.lesson.name}</TableCell>
            <TableCell align="right">{data.lessonInformation.lesson.subject.name}</TableCell>
            <TableCell align="right">{data.nbGroupSelected}</TableCell>
            <TableCell align="right">{data.lessonInformation.nbGroups}</TableCell>
            <TableCell align="right">{data.lessonInformation.lessonType.name}</TableCell>
            <TableCell align="right">
                <TextField
                    sx={{
                    zIndex: 0}}
                    type="number"
                    InputProps={{ inputProps: { min: 0, max: data.lessonInformation.nbGroups } }}
                    placeholder={data.nbGroupSelected}/>
            </TableCell>
        </TableRow>
    );
}

export default TeacherChoiceItem;