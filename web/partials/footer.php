<?php
/**
 * OpenChronology.org — shared footer partial
 *
 * Closes <main>, renders <footer>, injects the mobile nav toggle script,
 * and closes </body></html>.
 *
 * Usage: include at the very end of every page, after all <main> content:
 *   <?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>
 *
 * If a page needs page-specific JavaScript, set $page_scripts before including:
 *   $page_scripts = '<script>/* page-specific JS *\/</script>';
 *   include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php';
 */

$page_scripts = $page_scripts ?? '';
?>

<!-- ═══ FOOTER ════════════════════════════════════════════════════════════ -->
<footer class="site-footer">
  <div class="footer-inner">
    <div>
      <a href="/" class="footer-brand">
        <span class="footer-brand-dot" aria-hidden="true"></span>
        OpenChronology
      </a>
      <p class="footer-tagline">An open standard for chronological data.<br>CC-BY-4.0 &nbsp;&#183;&nbsp; Spec v0.3 Pre-Release</p>
    </div>
    <ul class="footer-links">
      <li><a href="/specification.php">Specification</a></li>
      <li><a href="https://schemas.openchronology.org" target="_blank" rel="noopener">Schemas</a></li>
      <li><a href="/libraries.php">Libraries</a></li>
      <li><a href="/working-group.php">Working Group</a></li>
      <li><a href="/ai-guide.php">AI Guide</a></li>
      <li><a href="https://chronology.studio" target="_blank" rel="noopener">Chronology Studio</a></li>
      <!-- <li><a href="https://github.com/knoj/openchronology" target="_blank" rel="noopener">GitHub</a></li> -->
    </ul>
    <p class="footer-copy">
      OpenChronology is an open standard published under the Creative Commons Attribution 4.0 International License.
      The 1000 Year Project is an anchor project of OpenChronology &#8212;
      <a href="https://1000yearproject.org" target="_blank" rel="noopener" style="color:rgba(255,255,255,0.4)">1000yearproject.org</a>
    </p>
  </div>
</footer>


<!-- ═══ SCRIPTS ═══════════════════════════════════════════════════════════ -->
<script>
// ── Mobile nav toggle ──────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function () {
  var toggle = document.getElementById('navToggle');
  var links  = document.getElementById('navLinks');
  if (!toggle || !links) return;

  toggle.addEventListener('click', function () {
    var isOpen = links.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', String(isOpen));
  });

  links.querySelectorAll('a').forEach(function (a) {
    a.addEventListener('click', function () {
      links.classList.remove('is-open');
      toggle.setAttribute('aria-expanded', 'false');
    });
  });
});
</script>

<?= $page_scripts ?>

</body>
</html>
