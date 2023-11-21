import React from "react";
import {TableCell, TableRow} from "@mui/material";

function ChoiceItemHistory({data}) {
    console.log(data);

    return (
        <TableRow>
            <TableCell component="th" scope="row">{data.lessonInformation.lesson.name}</TableCell>
            <TableCell component="th" scope="row">{data.lessonInformation.lesson.subject.semester.name}</TableCell>
            <TableCell component="th" scope="row">{data.lessonInformation.lesson.subject.name}</TableCell>
            <TableCell component="th" scope="row">{data.lessonInformation.lessonType.name}</TableCell>
            <TableCell component="th" scope="row">{data.nbGroupSelected}</TableCell>
            <TableCell component="th" scope="row">{data.lessonInformation.nbGroups}</TableCell>
            <TableCell component="th" scope="row">{data.year}</TableCell>
        </TableRow>
    )
}
export default ChoiceItemHistory