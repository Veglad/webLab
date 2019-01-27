<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8"/>
		<link type="text/css" rel="stylesheet" href="styles/style.css"/>
		<title>Новости</title>
        <script type="text/javascript" src="scripts/main_animation.js"></script>
        <script type="text/javascript" src="scripts/form.js"></script>
	</head>
	<body>
		<div id="wrapper">
            
            <?php 
            $content_title = "Новости";
            include("includes/header.inc.php");?>
            <main>
            <?php
            include("includes/sidebar.inc.php");
            include("includes/content_title.inc.php");
            ?>	
				<div id="content">
							<p><span class="tab"></span>For each instruction, one prefix may be used from each of these groups and be placed in any
					order. Using redundant prefixes (more than one prefix from a group) is reserved and may cause
					unpredictable behavior.</p>

					    <p><span class="tab"></span>The LOCK prefix forces an atomic operation to insure exclusive use of shared memory in a
					multiprocessor environment. See “LOCK—Assert LOCK# Signal Prefix” in Chapter 3, Instruction
					Set Reference, for a detailed description of this prefix and the instructions with which it can
					be used.</p>

					     <p><span class="tab"></span>The repeat prefixes cause an instruction to be repeated for each element of a string. They 
					can be used only with the string instructions: MOVS, CMPS, SCAS, LODS, STOS, INS, and OUTS.
					Use of the repeat prefixes with other IA-32 instructions is reserved and may cause unpredictable
					behavior (see the note below).</p>

					     <p><span class="tab"></span>The branch hint prefixes allow a program to give a hint to the processor about the most 
					likely code path that will be taken at a branch. These prefixes can only be used with the 
					conditional branch instructions (Jcc). Use of these prefixes with other IA-32 instructions is 
					reserved and may cause unpredictable behavior. The branch hint prefixes were introduced in the 
					Pentium 4 and Intel Xeon processors as part of the SSE2 extensions.</p>
				</div>
                <?php
                include("includes/footer.inc.php");
                ?>
            </main>
        </div>
	</body>
</html