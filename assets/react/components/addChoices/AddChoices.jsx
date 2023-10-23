import React, { useEffect, useState } from 'react'
import { fetchSemesters } from "../../services/api/choice";
import SemesterItem from "./SemesterItem";
import Tabs from '@mui/material/Tabs';
import Tab from '@mui/material/Tab';
import Box from '@mui/material/Box';
import Typography from '@mui/material/Typography';

// permet de gérer les onglets et de les générers
function TabPanel({ children, value, index, ...other }) {
  return (
    <div role="tabpanel" hidden={value !== index} {...other}>
      {value === index && (
        <Box p={3}>
          <Typography>{children}</Typography>
        </Box>
      )}
    </div>
  );
}

function AddChoices() {

  const [currentTab, setCurrentTab] = React.useState(0);

  const handleChange = (event, newTab) => {
    setCurrentTab(newTab);
  };

  const [semestersList, setSemestersList] = useState(null);
  const [semesters, setSemesters] = useState(null);

  useEffect(() => {
    fetchSemesters().then((data) => {
      console.log(data["hydra:member"])
      setSemestersList(
        data["hydra:member"].map((semester) => (
          <SemesterItem key={semester.id} data={semester} />
        ))
      );
    });
    
    // fetch tout les semestres et les gardes en json
    fetchSemesters().then((data) => {
      setSemesters(data["hydra:member"]);
    }
    );
  }, []);
    

  if (semesters === null) {
    return <div>Loading...</div>;
  }

  return (
    <div>
      <Tabs
        value={currentTab}
        onChange={handleChange}
      >
        {semesters.map((semester) => (
          <Tab key={semester.id} label={semester.name} />
        ))}
      </Tabs>

      {semesters.map((semester, index) => (
        <TabPanel key={semester.id} value={currentTab} index={index}>
          {semester.year}
          {index}
        </TabPanel>
      ))}
    </div>
  )
}

export default AddChoices