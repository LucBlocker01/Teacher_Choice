import React, { useEffect, useState } from 'react'
import { fetchSemesters } from "../../services/api/choice";
import { Tabs, Tab, Box, Typography, Container } from '@mui/material';
import SubjectList from "./SubjectList";
import Backtrack from "../../controllers/Backtrack";
import {getCurrentYear} from "../../partials/currentYear";
import {fetchSemesterByYear} from "../../services/api/api";

// permet de gérer les onglets et de les générers
function TabPanel({ children, value, index, ...other }) {
  return (
    <div role="tabpanel" hidden={value !== index} {...other}>
      {value === index && (
        <Box p={3}>
          <Typography component={'span'} >{children}</Typography>
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

  const currentYear =  getCurrentYear();

  useEffect(() => {
    // fetch tout les semestres et les gardes en json
      fetchSemesterByYear(currentYear).then((data) => {
        setSemesters(data["hydra:member"]);
      }
    );
      document.title = "SetURCAlendar - Ajouter Choix"
  }, []);

  if (semesters === null) {
    return <div>Loading...</div>;
  }

  return (
      <>
          <Backtrack></Backtrack>
      <Container>
      <Tabs
        value={currentTab}
        onChange={handleChange}
        sx={{ display:"flex", justifyContent:"wrap"}}
      >
        {semesters.map((semester) => (
          <Tab key={semester.id} label={
              <Box component="span" sx={{ color: "text.main" }}>
                  {semester.name}
              </Box>} sx={{ minWidth: 50 }} />
        ))}
      </Tabs>

      {semesters.map((semester, index) => (
        <TabPanel key={semester.id} value={currentTab} index={index}>
          <SubjectList data={semester.id} />
        </TabPanel>
      ))}
      </Container>
      </>
  )
}

export default AddChoices