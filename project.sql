-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2024 at 03:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `analysis`
--

CREATE TABLE `analysis` (
  `id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `analysis`
--

INSERT INTO `analysis` (`id`, `note_id`, `content`) VALUES
(1, 1, '**Key Insights:**\n\n* Elderly patient (80 years old) with a history of smoking.\n* Presented with fever, cough, and hypoxemia.\n* Diagnosed with community-acquired pneumonia (CAP) and intubated due to respiratory failure.\n* Pinkish frothy sputum after intubation suggests potential pulmonary edema or alveolar hemorrhage.\n* Bilateral airspace opacities on chest X-ray.\n* Elevated troponin suggests possible cardiac involvement (e.g., coronary artery disease or congestive heart failure).\n\n**Potential Diagnoses:**\n\n* Pneumonia\n* Pulmonary edema\n* Alveolar hemorrhage\n* Coronary artery disease\n* Congestive heart failure\n\n**Recommended Follow-Ups:**\n\n* **Pulmonary evaluation:**\n    * Ultrasound of left chest to assess for pleural effusion or consolidation.\n    * Bronchoscopy to rule out alveolar hemorrhage.\n* **Cardiac evaluation:**\n    * Repeat troponin levels to monitor cardiac status.\n    * Echocardiogram to assess cardiac function and exclude coronary artery disease.\n* **Respiratory support:**\n    * Continue mechanical ventilation and adjust settings as needed.\n    * Provide supplemental oxygen therapy.\n* **Diuretics:**\n    * Increase diuresis to manage potential pulmonary edema.\n* **Additional tests:**\n    * Complete blood count to assess for anemia (if alveolar hemorrhage is suspected).\n    * Coagulation studies to rule out coagulopathy (if alveolar hemorrhage is suspected).'),
(2, 2, '**Clinical Note:**\n\n**Chief Complaint:** Headache\n\n**History of Present Illness:**\n\nThe patient is a 35-year-old male who presents with a chief complaint of headache. He describes the headache as a dull, aching pain located in the right temporal area. The pain has been present for the past 3 days and has gradually worsened. He rates the pain as 7 out of 10. The patient denies any associated nausea, vomiting, or photophobia. He also denies any recent head trauma or fever.\n\n**Past Medical History:**\n\nThe patient has no significant past medical history.\n\n**Medications:**\n\nThe patient is not currently taking any medications.\n\n**Physical Examination:**\n\n**Neurological:**\n\n* Alert and oriented x3\n* Pupils equal and reactive to light\n* Cranial nerves II-XII intact\n* Motor and sensory examination within normal limits\n\n**Physical Exam:**\n\n* No meningismus\n* No focal neurological deficits\n\n**Assessment:**\n\nHeadache, likely tension-type\n\n**Plan:**\n\n* Recommend over-the-counter pain relievers (e.g., ibuprofen or acetaminophen)\n* Advise patient to rest and apply cold compresses to the affected area\n* Follow-up in 1 week for reevaluation\n\n**Key Insights:**\n\n* The patient\'s headache is likely tension-type based on the following characteristics:\n    * Dull, aching pain\n    * Located in the temporal area\n    * No associated nausea, vomiting, or photophobia\n    * No recent head trauma or fever\n\n**Potential Diagnoses:**\n\n* Tension-type headache\n* Migraine headache\n* Cluster headache\n\n**Recommended Follow-Ups:**\n\n* Follow-up in 1 week for reevaluation\n* If the patient\'s headache does not improve or worsens, further evaluation may be necessary, including:\n    * Neuroimaging (e.g., CT scan or MRI)\n    * Electroencephalography (EEG)\n    * Referral to a neurologist'),
(3, 3, '**Key Insights:**\n\n* 80-year-old female with a history of smoking presents with fever, cough, and hypoxemia.\n* Intubation was required due to hypoxemia.\n* Pinkish frothy sputum was observed after intubation.\n* Chest X-ray shows diffuse bilateral airspace opacities.\n* Laboratory findings include elevated troponin, suggesting cardiac involvement.\n\n**Potential Diagnoses:**\n\n* Community-acquired pneumonia (CAP)\n* Acute respiratory failure\n* Bilateral pulmonary infiltrates\n* Pulmonary edema\n* Worsening pneumonia\n* Alveolar hemorrhage\n* Chronic obstructive pulmonary disease (COPD)\n* Coronary artery disease (CAD)\n* Congestive heart failure (CHF)\n\n**Recommended Follow-Ups:**\n\n* **Urgent:**\n    * Increase diuresis\n    * Ultrasound of the left chest to assess for pleural effusion\n    * Thoracentesis if effusion is present\n    * Bronchoscopy to evaluate for alveolar hemorrhage\n* **Consultation with cardiology:**\n    * Evaluate elevated troponin and potential CAD\n* **Close monitoring:**\n    * Respiratory status\n    * Cardiac function\n    * Laboratory values (including troponin, hemoglobin)\n* **Additional testing:**\n    * Chest CT to further characterize pulmonary infiltrates\n    * Echocardiogram to assess cardiac function\n    * Pulmonary function tests to evaluate for COPD\n* **Empiric treatment:**\n    * Antibiotics for CAP\n    * Diuretics for pulmonary edema\n    * Oxygen therapy for respiratory failure'),
(4, 4, '**Key Insights:**\n\n* Jane Smith, a 38-year-old female, presents with a 3-day history of severe, right-sided throbbing headaches.\n* The headaches are accompanied by dizziness, nausea, photophobia, and phonophobia.\n* She has a history of migraine headaches diagnosed in 2010.\n* Over-the-counter pain medications have provided minimal relief.\n\n**Potential Diagnoses:**\n\n* Migraine headache\n* Tension headache\n* Cluster headache\n\n**Recommended Follow-ups:**\n\n* Schedule a follow-up appointment in 4 weeks or sooner if symptoms persist or worsen.\n* Check TSH levels to ensure adequate control of hypothyroidism.\n* Maintain a headache diary to identify potential triggers.\n* Use prescribed medication (sumatriptan) at the onset of headache.\n\n**Additional Recommendations:**\n\n* Avoid known migraine triggers, such as stress, certain foods, and lack of sleep.\n* Engage in regular aerobic exercise, which can help reduce headache frequency and severity.\n* Consider stress-reducing techniques, such as yoga, meditation, or biofeedback.\n* Explore preventive medications if headaches are frequent or disabling.');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `user` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `topic_id`, `content`, `user`, `date`) VALUES
(1, 1, 'fgsgsfg', 'Smolx', '2024-12-21'),
(2, 1, 'hello', 'Smolx', '2024-12-21'),
(3, 1, 'gdgd', 'Smolx', '2024-12-22'),
(10, 1, 'xczxvzxv', 'Smolx', '2024-12-22'),
(12, 1, 'fdsfdsfds', 'Smolx', '2024-12-22'),
(13, 1, 'fsgsfgsfgsfgs', 'Tawy', '2024-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `user` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `content`, `user`, `date`) VALUES
(1, 'Associated Diagnoses: None .\n\nSubjective:\n\n11/30/15: 80 who presented to the hospital with 3 days history of fever and cough. She was\ndiagnosed with CAP and was started on antibiotics. Unfortunately, she had a significant\nepisode of hypoxemia and had to be intubated. Pinkish frothy sputum was reported after\nintubation. Patient has a remote history of smoking.\n\n11/30/2015 06:00 Transparent Physical Examination General: intubated and sedated. Eye:\nPupils are equal, round and reactive to light, Extraocular movements are intact. HENT:\nintubated and sedated. Neck: Supple, No lymphadenopathy. Respiratory: bilateral rales.\nCardiovascular: Normal rate, Regular rhythm, No murmur. Gastrointestinal: Soft, Non-\ndistended. Musculoskeletal: intubated and sedated. Integumentary: Warm, Dry. Neurologic:\nintubated and sedated. Results Review Labs Last 24 Hrs SELECT Labs ONLY\n\n12/01/2015 06:52 - XR Chest PA AP Portable IMPRESSION: Diffuse bilateral airspace\nopacities. Interval improvement. Impression and Plan 1- Acute respiratory failure 2- Bilateral\ninfiltrate: pulm edema vs. worsening pneumonia vs. alveolar hemorrhage (bloody sputum\nand HB dropped 2 grs) 3- Pneumonia 4- COPD: seen on CT chest 2014 5- Troponin elevation:\ntroponin went up to 2 due to her respiratory failure. However, her echo is very suggestive of\nCAD. Appreciate cardiology. 6- CHF: sudden bilateral infiltrates and high troponin Plan\nIncrease diuresis US of left chest and tap if needed bronch......', '19', '2024-12-29'),
(2, 'headache', '19', '2024-12-29'),
(3, 'Associated Diagnoses: None .\n\nSubjective:\n\n11/30/15: 80 who presented to the hospital with 3 days history of fever and cough. She was\ndiagnosed with CAP and was started on antibiotics. Unfortunately, she had a significant\nepisode of hypoxemia and had to be intubated. Pinkish frothy sputum was reported after\nintubation. Patient has a remote history of smoking.\n\n11/30/2015 06:00 Transparent Physical Examination General: intubated and sedated. Eye:\nPupils are equal, round and reactive to light, Extraocular movements are intact. HENT:\nintubated and sedated. Neck: Supple, No lymphadenopathy. Respiratory: bilateral rales.\nCardiovascular: Normal rate, Regular rhythm, No murmur. Gastrointestinal: Soft, Non-\ndistended. Musculoskeletal: intubated and sedated. Integumentary: Warm, Dry. Neurologic:\nintubated and sedated. Results Review Labs Last 24 Hrs SELECT Labs ONLY\n\n12/01/2015 06:52 - XR Chest PA AP Portable IMPRESSION: Diffuse bilateral airspace\nopacities. Interval improvement. Impression and Plan 1- Acute respiratory failure 2- Bilateral\ninfiltrate: pulm edema vs. worsening pneumonia vs. alveolar hemorrhage (bloody sputum\nand HB dropped 2 grs) 3- Pneumonia 4- COPD: seen on CT chest 2014 5- Troponin elevation:\ntroponin went up to 2 due to her respiratory failure. However, her echo is very suggestive of\nCAD. Appreciate cardiology. 6- CHF: sudden bilateral infiltrates and high troponin Plan\nIncrease diuresis US of left chest and tap if needed bronch......', '22', '2024-12-29'),
(4, 'Chief Complaint:\nSevere headache and dizziness.\n\nHistory of Present Illness:\nJane Smith is a 38-year-old female who presents with a 3-day history of severe, throbbing headaches primarily located on the right side of her head. The headaches are accompanied by dizziness and occasional nausea. She reports photophobia and phonophobia during headache episodes. No aura is noted. Over-the-counter pain medications have provided minimal relief.\n\nPast Medical History:\n\nMigraine headaches, diagnosed in 2010\nHypothyroidism\nMedications:\n\nLevothyroxine 75 mcg daily\nIbuprofen as needed for pain\nAllergies:\n\nNone\nSocial History:\n\nNon-smoker\nDrinks alcohol socially\nWorks as a graphic designer\nFamily History:\n\nMother: Migraines\nFather: Hypertension\nReview of Systems:\n\nNeurological: Headache, dizziness\nGastrointestinal: Occasional nausea, no vomiting\nMusculoskeletal: No joint pain or stiffness\nPhysical Examination:\n\nVital Signs: BP 120/78 mmHg, HR 72 bpm, RR 16 breaths/min, Temp 98.4°F\nGeneral: Alert, appears uncomfortable due to headache\nHEENT: No sinus tenderness, pupils equal and reactive to light\nNeurological: Cranial nerves II-XII intact, no focal neurological deficits\nCardiovascular: Regular rate and rhythm, no murmurs\nAssessment and Plan:\n\nMigraine headache: Likely exacerbated by stress. Prescribe sumatriptan for acute migraine relief. Advise on lifestyle modifications, including regular sleep and hydration.\nHypothyroidism: Continue current medication. Check TSH levels to ensure adequate control.\nFollow-up: Schedule a follow-up appointment in 4 weeks or sooner if symptoms persist or worsen.\nInstructions:\n\nAvoid known migraine triggers\nMaintain a headache diary to identify potential triggers\nUse prescribed medication at the onset of headache', '22', '2024-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user` text NOT NULL,
  `replies` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `title`, `description`, `user`, `replies`, `date`) VALUES
(1, 'gfgfg', 'fgfgfg', 'Smolx', 6, '2024-12-21'),
(2, 'gfg', 'gffg', 'Smolx', 0, '2024-12-21'),
(7, 'gfsgsf', 'sgfgsfg', 'Smolx', 0, '2024-12-21'),
(8, 'Magdy', 'hgdhdghdghdghdg\r\n', 'Smolx', 0, '2024-12-21'),
(9, 'dgshdgh', 'dsghdghdgh', 'Smolx', 0, '2024-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `description` text NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`, `created_at`, `description`, `role`) VALUES
(19, 'Zeyad', 'zeyadtantawy@gmail.com', 'Sheep#123', '2024-12-28 23:40:27', '', 'ADMIN'),
(22, 'Smolx', 'mohamedmagdy@gmail.com', 'Smolx#7890', '2024-11-28 20:38:43', '', 'USER'),
(29, 'D_-VIL', 'kareemahmed@gmail.com', 'Kareem#7890', '2024-11-28 20:38:31', '', 'USER'),
(42, 'fatma', 'Fatma@gmail.com', 'Fatma#1234', '2024-12-28 23:43:13', '', 'USER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analysis`
--
ALTER TABLE `analysis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analysis`
--
ALTER TABLE `analysis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
