import React from "react";
import {Box, Chip, TableCell, TableRow, Tooltip} from "@mui/material";
import RemoveCircleIcon from "@mui/icons-material/RemoveCircle";
import AddCircleIcon from "@mui/icons-material/AddCircle";
import CancelIcon from "@mui/icons-material/Cancel";

function ChoiceItemHistory({data}) {
    console.log(data);

    return (
        <TableRow>
            <TableCell component="th" scope="row">{data.lessonInformation.nbGroups}</TableCell>
            <TableCell component="th" scope="row">{data.lessonInformation.nbGroups}</TableCell>
            <TableCell component="th" scope="row">{data.lessonInformation.nbGroups}</TableCell>
            <TableCell component="th" scope="row">{data.lessonInformation.lessonType.name}</TableCell>
            <TableCell component="th" scope="row">{data.nbGroupSelected}</TableCell>
            <TableCell component="th" scope="row">{data.lessonInformation.nbGroups}</TableCell>
        </TableRow>
    )
}
export default ChoiceItemHistory