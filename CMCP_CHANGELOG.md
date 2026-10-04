# CMCP Orchestration Journal

## 2026-10-04 — engine-20261004093454-attaching-6c890d reconnaissance and RC hardening

### Baseline and reconnaissance
- WRITE_ALLOWED boundary is Attaching only; sibling repositories were consumed read-only through Console MCP.
- Canonical workspace resolved to `D:\\PhpstormProjects\\www\\Attaching`; branch `rc/attaching-canonical-merge-20260922` was clean and synchronized with origin at baseline (ahead 0 / behind 0).
- The supplied 2026-09-29 Gating report was RED only on Canon052, but the current executable `composer gate` is GREEN with zero failures/warnings; the prior Canon052 failure is stale for the current HEAD.
- Supplied Inspecting evidence has five medium observations: four long-method advisories and one `AttachmentEntity` public-surface advisory; no hard Inspecting blocker was present.

### Canon / dependency mapping
- Read current Attaching `AGENTS.md`, `README.md`, `composer.json`, production Composer manifest and ignore policy.
- Read mandatory Objecting, Cruding, Viewing, Interfacing root contracts plus Gating and Canonization root contracts.
- Normative Canon052 was read directly: consumer `.gating/` is artifact-only while Gating policy/executable ownership stays in `gating/gate`; current Attaching integration satisfies the live executable gate.
- Canon024 confirms production Composer resolution must remain independent of sibling filesystem paths; current `composer.prod.json` uses package/VCS resolution rather than local path repositories.

### Market / maturity split
- RC baseline for attachment systems: deterministic content/metadata validation, integrity/checksum safeguards, lifecycle-safe association/deletion, confined storage paths, authorization-aware delivery, reproducible package wiring, and deterministic maintenance behavior.
- Growth remains non-blocking: object-storage/direct uploads, resumable transfer, malware/quarantine processing, asynchronous derivatives/previews, richer metadata, and UX/API expansion.

### Material RC hardening
- Closed the specific Canon031 documentation debt identified on the production `AttachmentMigrateIdentifiersCommand` class and `execute()` contract with factual PHPDoc describing PostgreSQL scope, idempotence, transaction preservation, and relationship integrity.
- No runtime behavior, SQL ordering, CLI name, command output, schema contract, UI, forms, navigation, or browser/mobile flow was changed.

### Verification plan
- Run changed-file PHP lint, PHP-CS-Fixer, PHPStan, PHPUnit, current Gating, strict Composer validation/check-lock, audit, and post-mutation Inspecting.
- Behavioral/UI and visual verification are not applicable unless deterministic verification discovers a user-observable effect.

Что имеем? Current Canon052 is executable-green and one concrete production PHPDoc gap from the supplied Canon031 evidence is materially closed without behavior change.

Что осталось? Complete deterministic verification, post-mutation Inspecting, then signed commit/push and final HEAD/upstream/worktree inspection if all gates remain green.

### Acceptance verification
- Changed-file PHP lint: PASS.
- `composer quality`: PASS — PHP-CS-Fixer 0/97 fixes, PHPStan 0 errors, PHPUnit 41 tests / 243 assertions, Gating 10 rules with 0 failures / 0 warnings.
- `composer validate --strict --check-lock`: PASS.
- `composer audit --format=summary`: PASS — no security vulnerability advisories.
- Post-mutation Inspecting: COMPLETE — PHPStan 0 errors; the same five medium php-structure observations remain. The PHPDoc mutation closes the reported Canon031 documentation gap but does not address the separate long-method/design observations.
- Behavioral/UI and visual verification: not applicable; no user-observable UI, navigation, form, interaction, or mobile/browser flow changed.

Что имеем? The current RC-hardening batch is deterministic-green and the prior Canon052 RED is confirmed stale for the live repository state.

Что осталось? Create one signed commit for the command documentation plus orchestration journal, push the current branch, and verify final HEAD/upstream/worktree state.

## 2026-10-04 — engine-20261004184440-attaching-1d83bc Failing adoption acceptance

### Baseline and reconnaissance
- WRITE_ALLOWED boundary is Attaching only; sibling repositories were consumed read-only through Console MCP.
- Branch `rc/attaching-canonical-merge-20260922` was synchronized with origin at baseline (ahead 0 / behind 0) with five pre-existing dirty paths: `AGENTS.md`, `composer.json`, `composer.lock`, `composer.prod.json`, and `config/bundles.php`.
- The supplied 2026-09-29 CanonScanning report was RED only on Canon052. Current repository history/journal shows that consumer `.gating/` owner-copy failure was subsequently remediated and published; current executable Gating is GREEN.
- Canonization textual rules consulted directly: Canon052 plus Canon064-066 and the Guard Matrix. Mandatory Objecting, Cruding, Viewing, Interfacing and Gating root contracts were re-read. Failing exposes `failing/failure` as a Symfony bundle owning consumer-agnostic failure contracts/RFC 9457 integration.

### Market / maturity split
- RC baseline for attachment systems: deterministic validation, content integrity, storage confinement, lifecycle-safe association/deletion, authorization-aware delivery, deterministic failure semantics, and reproducible package/runtime wiring.
- Growth remains non-blocking: object-storage/direct uploads, resumable transfer, malware/quarantine processing, derivatives/previews, richer metadata, and broader UX/API capability.

### Material batch classified
- `composer.json`: adopts `failing/failure` at canonical `dev-master` and exposes local `../Failing` path+symlink identity.
- `composer.prod.json`: adopts the packaged production `failing/failure` dependency without workstation path coupling.
- `config/bundles.php`: activates `App\Failing\FailingBundle` in standalone runtime.
- `composer.lock`: resolves the Failing package and current first-party sibling package metadata consistently with the manifest change.
- `AGENTS.md`: synchronizes the Canon021 EasyAdmin exception and Canon052 artifact-only `.gating/` projection with current textual Canonization.
- No Attaching business failure vocabulary is centralized into Failing; dependency direction remains consumer -> Failing.

### Acceptance verification
- `composer quality`: PASS — PHP-CS-Fixer 0/97 fixes, PHPStan 0 errors, PHPUnit 41 tests / 243 assertions, Gating 10 rules with 0 failures / 0 warnings.
- `composer validate --strict --check-lock`: PASS.
- `composer audit --format=summary`: PASS — no security vulnerability advisories.
- Post-mutation Inspecting: COMPLETE — PHPStan analyzer 0 errors; five medium php-structure observations remain (four long-method advisories plus AttachmentEntity public-surface advisory), with no hard blocker.
- Browser/mobile behavioral and visual verification is not applicable: this batch changes package/runtime wiring and agent-facing canon projection, not templates, forms, navigation, browser interactions, or mobile UI behavior.

Что имеем? Current Failing adoption/canon-projection batch is deterministic-green and respects Attaching/Faling responsibility direction.

Что осталось? Create one signed commit for the six coherent files, push the current branch, then verify final HEAD/upstream/worktree state.

## 2026-10-04 — engine-20261004182414-attaching-b00482 reconnaissance and Canon052 closure

### Baseline
- WRITE_ALLOWED scope is Attaching only; sibling repositories are read-only contract/evidence sources.
- Branch `rc/attaching-canonical-merge-20260922` is synchronized with its upstream at baseline (ahead 0 / behind 0) and already contains six pre-existing dirty paths: deleted `.gating/README.md`, plus modified `AGENTS.md`, `composer.json`, `composer.lock`, `composer.prod.json`, and `config/bundles.php`.
- Upstream CanonScanning fingerprint `55666093fc0d0246608665b8726c46d264d00c585cf511cdb1213b296fe542d4` was RED only on Canon052; supplied Inspecting evidence contains five medium maintainability/design observations and no hard blocker.

### Canon and dependency mapping
- Normative Canon052 was read directly from Canonization. It requires `gating/gate` as a development dependency, sibling `../Gating` symlink wiring pinned to `dev-master`, standard `gate` plus aggregate `quality`, a path-independent production Gating package declaration, and consumer `.gating/` limited to generated artifact state (optionally a non-executable boundary README).
- Objecting, Cruding, Viewing, Interfacing, Gating, and Canonization root contracts were re-read. Attaching declares the mandatory application dependency contour and keeps attachment responsibility local.
- Current `.gitignore` ignores `/.gating/`; therefore deleting the tracked `.gating/README.md` is a valid Canon052-conformant consumer topology (the README is optional, not required).

### Opening market / maturity split
- RC baseline: validated attachment metadata/content, checksum integrity, lifecycle-safe link/delete behavior, path confinement, deterministic failures, reproducible package wiring, and executable quality gates.
- Growth remains non-blocking: object storage/direct uploads, resumable transfer, malware/quarantine processing, derivatives/previews, richer metadata, and UX/API capability growth.

### RC-critical workstream
- Preserve the already-materialized Canon052 remediation and pre-existing dependency/Fallback wiring without destructive reset; prove the current working tree with aggregate quality, strict Composer validation, audit, and post-mutation Inspecting.
- No browser/mobile UI source is being changed by this pass; visual/behavioral execution is applicability-driven and expected to be not applicable unless verification exposes UI-affecting changes.

Что имеем? Canon052 root cause is factually understood and the live tree already contains the canonical consumer `.gating/` cleanup posture.

Что осталось? Execute current deterministic gates, inspect post-verification findings, then reconcile/commit/publish only coherent authorized work without destroying unrelated changes.

### Acceptance verification
- `composer quality`: PASS — PHP-CS-Fixer 0/97 fixes, PHPStan 0 errors, PHPUnit 41 tests / 243 assertions, Gating 10 rules with 0 failures / 0 warnings.
- `composer validate --strict --check-lock`: PASS.
- `composer audit --format=summary`: PASS — no security vulnerability advisories.
- Post-mutation Inspecting: COMPLETE — PHPStan analyzer 0 errors; the same five medium php-structure findings remain (four long-method advisories and one AttachmentEntity public-surface advisory), with no new finding introduced by this Canon052 closure.
- Behavioral/UI verification is not applicable: this task changes repository policy topology/journal only and does not change templates, forms, navigation, controllers, browser interactions, or mobile UI behavior.

### Git ownership classification
- Task-owned coherent Canon052 batch: deletion of tracked `.gating/README.md` plus this `CMCP_CHANGELOG.md` entry.
- Preserved pre-existing unrelated/mixed work remains unstaged: `AGENTS.md`, `composer.json`, `composer.lock`, `composer.prod.json`, and `config/bundles.php` (including Failing adoption and other canon projection updates).

Что имеем? Canon052 is closed by current executable evidence and the exact consumer `.gating/` topology is canonical without requiring a tracked README.

Что осталось? Commit and push only `.gating/README.md` deletion plus `CMCP_CHANGELOG.md`, then inspect final branch/upstream/worktree state.

### Integration result
- The first combined signed-commit staging attempt reported an ignore-path staging error for `.gating/README.md`, and index-only untrack correctly refused the already-absent working-tree path.
- A subsequent signed journal commit revealed the deletion was already staged and atomically committed it together with the journal: commit `b92ab3a` deletes tracked `.gating/README.md` and records this verification without touching the five unrelated pre-existing dirty paths.
- No destructive reset/restoration was used.

Что имеем? Repository correctness and acceptance are green, and the Canon052 consumer `.gating/` remediation is now committed in signed history.

Что осталось? Push the current branch and verify final HEAD/upstream/worktree state while preserving unrelated pre-existing dirty paths.

## 2026-10-04 — engine-20261004120050-attaching-28e0ae factual documentation reconciliation

### Baseline and ownership
- WRITE_ALLOWED boundary is Attaching only; Canonization, Gating, Objecting, Cruding, Viewing, Interfacing, and Inspecting were consumed as read-only contract/evidence sources.
- Upstream CanonScanning fingerprint `55666093fc0d0246608665b8726c46d264d00c585cf511cdb1213b296fe542d4` was RED only on Canon052 and carried five medium Inspecting observations; current `composer gate` is GREEN with zero failures/warnings, confirming the hard Gating-integration failure is no longer present in the live tree.
- Pre-existing dirty paths at this task baseline were `.gating/README.md`, `AGENTS.md`, `composer.json`, `composer.lock`, `composer.prod.json`, and `config/bundles.php`; this pass preserves their existing semantics and does not reset or overwrite them.

### Canon and dependency contour consulted
- Canonization root AGENTS/README, guard matrix, and normative Canon052 text were read. Canon052 maps Attaching to the `gating/gate` development dependency, canonical `../Gating` symlink repository, aggregate `quality`/`gate` scripts, production package dependency, and artifact-only consumer `.gating/` boundary.
- Objecting, Cruding, Viewing, Interfacing, and Gating root AGENTS/README/Composer contracts were re-read. Attaching keeps attachment lifecycle behavior local, Objecting owns reusable system fields, Cruding owns generic application CRUD, Viewing owns the rendering boundary, and Interfacing owns interface-shell concerns.

### Market and maturity split
- RC baseline: validated attachment metadata/content, checksum integrity, lifecycle-safe link/delete behavior, storage confinement, predictable failure behavior, and deterministic operational verification.
- Growth remains non-blocking: object-storage/direct uploads, resumable transfer, malware/quarantine workflows, asynchronous processing, derivatives/previews, and richer UX/API contracts.

### Material RC repair
- Corrected Antora architecture/API documentation from obsolete controller/service/repository/command paths to the current typed Symfony tree.
- Corrected the documented Symfony floor from `^8.0` to the actual `^8.1` Composer baseline.
- Replaced stale bundle-only/no-root-bootstrap language with the factual dual-runtime contract: reusable bundle exports plus repository-local `app/`, `bin/console`, and `config/` standalone verification runtime.
- Updated operational documentation to expose the standalone runtime without assigning host composition or unrelated responsibilities to Attaching.

### Verification plan
- Run aggregate `composer quality`, strict Composer validation/check-lock, Composer audit, and post-mutation Inspecting.
- No browser/mobile UI source, navigation, forms, templates, or interaction behavior changed; Panther/Playwright and visual screenshots are not expected to be applicable.
- Inspect final diff/status and publish only coherent task-owned documentation/journal paths while preserving unrelated pre-existing dirty work.

Что имеем? Canon052 is executable-green and a factual Canon017-style documentation drift has been materially repaired without runtime behavior change.

Что осталось? Aggregate acceptance, post-mutation Inspecting, then Git ownership/reconciliation and publication of only the task-owned documentation/journal files if safe.

### Acceptance verification
- `composer quality`: PASS — PHP-CS-Fixer 0/97 fixes, PHPStan 0 errors, PHPUnit 41 tests / 243 assertions, Gating 10 rules with 0 failures / 0 warnings.
- `composer validate --strict --check-lock`: PASS.
- `composer audit --format=summary`: PASS — no security vulnerability advisories.
- Post-mutation Inspecting: COMPLETE — PHPStan analyzer 0 errors; the same five medium php-structure observations remain (four long-method advisories and the AttachmentEntity public-surface advisory), with no new finding caused by the documentation repair.
- Browser/mobile behavioral evidence is not applicable: this task changed repository/Antora documentation and the CMCP journal only, not templates, forms, navigation, controllers, browser interactions, or mobile UI behavior.
- Git ownership review: task-owned changes are `CMCP_CHANGELOG.md` plus the four Antora pages. The six baseline dirty paths remain pre-existing and will stay unstaged.

Что имеем? RC-critical factual documentation repair is regression-free under aggregate quality, strict lock validation, security audit, and post-mutation Inspecting; current branch is synchronized with upstream before publication (ahead 0 / behind 0).

Что осталось? Create and push one signed commit containing only the five task-owned files, then inspect final branch/upstream/worktree state and any applicable pull-request integration evidence.

## 2026-10-04 — Autonomous reconnaissance and baseline hardening

### Baseline
- Target/write boundary: Attaching only; sibling repositories are read-only contract references.
- CanonScanning input report from 2026-09-29 was RED only on Canon052; fresh Inspecting evidence for fingerprint `55666093fc0d0246608665b8726c46d264d00c585cf511cdb1213b296fe542d4` contained five medium maintainability observations and no hard finding.
- Current worktree already contained pre-existing changes in `.gating/README.md`, `AGENTS.md`, `composer.json`, `composer.lock`, `composer.prod.json`, and `config/bundles.php`; those are preserved as existing work and are not silently rewritten by this pass.
- Current `composer gate` and full `composer quality` are GREEN on the working tree: PHP-CS-Fixer clean, PHPStan zero errors, PHPUnit 41 tests / 243 assertions, and the available Gating contour has zero failures/warnings.

### Contract reads and canon mapping
- Canonization textual rules consulted: Canon031, Canon034, Canon042, and Canon052 plus Canonization root AGENTS/README. Gating is executable enforcement; Canonization remains normative.
- Canon052 maps to the existing `gating/gate` dev dependency, sibling `../Gating` symlink repository, `gate`/`quality` Composer scripts, production package dependency, and artifact-only consumer `.gating/` boundary.
- Canon034 maps to Attaching `.gitignore`; the upstream RED-era report identified missing local-environment, OS-noise, and Node dependency coverage.
- Canon031 and Canon042 remain warning-level quality-growth debt; they do not block the current RC hardening pass.
- Mandatory application contour was re-read from Objecting, Cruding, Viewing, and Interfacing package/docs contracts. Attaching keeps attachment business behavior local, Objecting owns system fields, Cruding owns generic application CRUD, Viewing owns rendering boundary, and Interfacing owns shell/interface integration.

### Market / maturity contour
- Baseline expectations: durable attachment metadata, content/type validation, checksum/integrity protection, lifecycle-safe linking/deletion, authorization-aware downloads, and storage abstraction.
- Growth track remains separate: direct/presigned object-storage uploads, resumable large-file transfer, malware/quarantine workflows, asynchronous processing, derivatives/previews, and richer metadata.

### Material RC hardening
- Normalized `.gitignore` with explicit local-environment overrides, Windows/macOS noise, and `node_modules` coverage to close the concrete Canon034 warning without altering runtime behavior.

### Verification plan
- Re-run Gating and aggregate quality after the ignore-baseline mutation.
- Run post-mutation Inspecting because the repository fingerprint has changed.
- Inspect final diff/status/branch/upstream and publish only task-owned coherent files when safe; preserve unrelated pre-existing dirty work.

Что имеем? Current runtime/static/test baseline is green, Canon052 is no longer failing in the executable current tree, and Canon034 has a minimal deterministic hardening patch.

Что осталось? Post-mutation Gating/quality, Inspecting verification, then Git ownership/reconciliation and publication of only the task-owned hardening/journal files if safe.

### Acceptance verification
- `composer quality`: PASS — PHP-CS-Fixer clean, PHPStan 0 errors, PHPUnit 41 tests / 243 assertions, available Gating contour 0 failures / 0 warnings.
- `composer validate --strict --check-lock`: PASS.
- `composer audit --format=summary`: PASS — no security vulnerability advisories.
- Post-mutation Inspecting: COMPLETE — PHPStan analyzer 0 errors; the same five medium maintainability/design observations remain, with no new finding introduced by this pass.
- No browser/mobile UI, navigation, form, template, interaction, or user-flow source changed; Panther/Playwright execution and visual screenshots are not applicable to this hardening pass.

Что имеем? RC-critical mutation is regression-free under aggregate quality, strict Composer validation, dependency audit, and post-mutation Inspecting.

Что осталось? Final Git ownership/branch reconciliation, then commit and publish only `.gitignore` and `CMCP_CHANGELOG.md` if the upstream synchronization plan is safe.

## 2026-09-26 — Autonomous RC reconnaissance and Canon055 closure

### Baseline and contract reads
- Target boundary: Attaching only; sibling repositories remain read-only references.
- Current branch: `rc/attaching-canonical-merge-20260922`, tracking its origin branch with no ahead/behind divergence at baseline.
- Pre-existing dirty paths were `.gating/README.md` and `composer.json`; they are preserved as pre-existing work and are not folded into this RC repair.
- Mandatory dependency contour is declared in the current development Composer manifest: Objecting, Cruding, Viewing, and Interfacing, with local path/symlink wiring; Collectioning, Tabling, and Gating complete the current first-party development contour.
- Canonization textual rules consulted for this pass include Canon001, Canon007, Canon018, Canon019, Canon021, Canon022, Canon043, Canon044, Canon045, Canon047, Canon049, Canon051, Canon052, Canon053, Canon054, and Canon055, plus the architecture README and guard matrix.
- Gating was treated as executable enforcement while Canonization remained normative.

### Market and maturity contour
- RC baseline for attachment handling remains deterministic validation, integrity-safe storage, lifecycle-safe association/deletion, authorization-aware downloads, and explicit storage boundaries.
- Growth remains separate: object storage/direct upload, multipart transfer for large objects, malware/quarantine scanning, asynchronous processing, derivatives, and richer metadata.

### RC-critical workstream selected
- Run the actual aggregate quality gate and repair only factual Attaching-owned failures.
- `composer quality` found one hard failure: Canon055 detected three human-facing documentation lines that used the Smart Responsor consumer identity as shared platform/ecosystem identity.
- PHP-CS-Fixer, PHPStan, and PHPUnit were already green at this checkpoint (41 tests, 243 assertions); Composer strict validation and audit were also green.

### Material repair
- Reframed the Attaching AGENTS heading to neutral platform/consumer terminology.
- Reframed README and Antora landing text to neutral multi-domain SaaS platform terminology.
- Corrected README's documented Symfony floor from `^8.0` to the actual Composer `^8.1` constraint.

### Gates to close
- Re-run `composer quality` and verify Canon055 is green.
- Re-check strict Composer validation/audit and final Git worktree/branch state.
- Preserve the two pre-existing dirty paths unless repository evidence proves they belong to this task.

Что имеем? Фактический hard-gate Canon055 локализован и исправлен в Attaching-owned documentation без изменения runtime behavior.

Что осталось? Повторить aggregate quality и финальный Git/integration review, затем интегрировать только новые coherent owned paths.

### Acceptance verification
- `composer quality`: PASS — PHP-CS-Fixer clean, PHPStan 0 errors, PHPUnit 41 tests / 243 assertions, Gating 9 rules / 0 failures / 0 warnings.
- Canon055 now passes: no consumer identity is promoted to platform identity in current human-facing documentation.
- `composer validate --strict --check-lock`: PASS.
- `composer audit --format=summary`: PASS — no security vulnerability advisories.
- No runtime, browser-flow, form, navigation, template, or mobile behavior changed; Playwright/Panther and visual evidence are therefore not applicable to this repair.
- Git ownership review confirms only `AGENTS.md`, `README.md`, `docs/modules/ROOT/pages/index.adoc`, and this journal belong to the current repair. Pre-existing `.gating/README.md` and `composer.json` remain preserved and unstaged.

Что имеем? Aggregate quality, Canon055, strict lock validation, tests, static analysis and dependency audit are green for the repaired working tree.

Что осталось? Создать и опубликовать отдельный signed commit только из четырёх owned paths; затем проверить post-push branch/upstream state.

### Post-publication residual classification
- Signed commit `a84096eeee87f72bca3fafeb8ac8baa6691faaef` was pushed successfully; branch is synchronized with upstream (ahead 0 / behind 0).
- Residual `.gating/README.md` is pre-existing user work and conflicts with current Canon052 textual authority: consumer-local `.gating/` is artifact-only and may contain only a non-executable README describing that boundary, while the dirty version copies owner-level Gating package/policy documentation. It must not be silently overwritten under the preservation/destructive-operation constraints.
- Residual `composer.json` changes package license from `proprietary` to `PolyForm-Noncommercial-1.0.0`, while `composer.prod.json` remains `proprietary`. Canon033 does not define license as identity parity, so there is no deterministic canon rule authorizing a production-license rewrite. This is a product/legal licensing decision rather than an RC code repair.
- Neither residual path blocks the already-published Canon055 repair, and neither is safe to absorb into an autonomous commit without changing ownership or legal intent.

Что имеем? Task-owned RC repair is fully published and upstream-synchronized; the only remaining dirty state is precisely classified pre-existing work.

Что осталось? Human-owned disposition of the consumer `.gating/README.md` copy and the development-only license change; no further autonomous Attaching code repair is justified from repository evidence.

### Explicit residual resolution
- User explicitly authorized resolving the two residual paths.
- `.gating/README.md` was restored to the Canon052-compliant consumer artifact-only README.
- The existing development-manifest license change to `PolyForm-Noncommercial-1.0.0` was retained intentionally. This matches the current development manifests of Objecting, Cruding, Viewing, Interfacing, Collectioning, Tabling, and Gating.
- `composer.prod.json` remains `proprietary`, matching the prevailing development/production licensing split across those sibling platform packages except Objecting, whose production manifest also uses PolyForm.
- No runtime/UI behavior changed.

Что имеем? The two residual Attaching paths now have an explicit, evidence-backed disposition.

Что осталось? Re-run quality, strict Composer validation, audit, inspect final diff, then publish the residual-resolution commit.

### Residual-resolution acceptance
- `composer quality`: PASS — PHP-CS-Fixer clean, PHPStan 0 errors, PHPUnit 41 tests / 243 assertions, Gating 9 rules with 0 failures and 0 warnings.
- `composer validate --strict --check-lock`: PASS.
- `composer audit --format=summary`: PASS — no security vulnerability advisories.
- Final dirty scope before commit: `composer.json` plus this CMCP journal only; `.gating/README.md` is back to canonical HEAD content and no longer dirty.

Что имеем? Residual cleanup is fully validated and limited to the intended license metadata plus orchestration journal.

Что осталось? Signed commit, push, and post-push branch/upstream verification.

## 2026-09-11 — Iteration 1/5: reconnaissance and baseline

### Scope and repository state
- Target/write boundary: `Attaching` only (`D:\PhpstormProjects\www\attaching`).
- Branch: `refactor/canonical-attachment-tree-v2`.
- Pre-existing worktree state: untracked `.gating/`; it is not modified by this iteration.
- Package identity: `attaching/attachment`; runtime namespace is `App\Attaching\` under `src/`.
- Current production dependency declared by Attaching: `objecting/object` via local symlink path repository `../Objecting`.
- Mandatory application contour was inspected through the local `Objecting`, `Cruding`, `Viewing`, and `Interfacing` package contracts. Attaching currently declares only Objecting; no production PHP imports of Cruding, Viewing, or Interfacing were found during the initial dependency scan, so adding those packages is deferred until an actual runtime contract is identified rather than inventing coupling.

### Material read surface
- Target: `AGENTS.md`, `README.md`, `composer.json`, `CHANGELOG.md`, `docs/release/release-process.adoc`, `docs/antora.yml`, principal attachment entities, QA configuration, and current source/test topology.
- Objecting: `README.md`, `composer.json`, `ObjectStateEmbeddableTrait`, `ObjectStateEmbeddable`, `ObjectTitleEmbeddableTrait`, and `ObjectTitleEmbeddable`.
- Cruding, Viewing, Interfacing: each repository `README.md` and `composer.json` responsibility/package contracts.
- Canonization: root `README.md`, architecture canon README, and normative rules `Canon004`, `Canon005`, `Canon007`, `Canon008`, `Canon010`, `Canon017`, `Canon018`, and `Canon019`.
- Gating: root `README.md` and `composer.json`; Gating is treated as executable enforcement, not the normative source.

### Canon mapping
- `Canon004` subject-folder placement: Attaching is role-first overall, but current `src/**/Attachment/` folders require later targeted review because early subject folders are prohibited outside the Entity exception unless the depth/context is justified.
- `Canon005` meaningful namespace tokens: retain technical-role families only when each token predicts responsibility; avoid ceremonial `Attachment` repetition.
- `Canon007` literal PSR-4 identity: current `App\Attaching\ => src/` mapping is the migration invariant for any later tree edits.
- `Canon008` dependency integrity: Objecting usage is backed by `objecting/object`. No Cruding/Viewing/Interfacing namespace usage was found in the first production import scan; do not add undeclared runtime imports or speculative dependencies.
- `Canon010` migration completeness: any later topology or field migration must update code, tests, Symfony config/routes, fixtures, docs, and metadata together.
- `Canon017` docs/runtime parity: README currently says persistence is under `src/Entity/`, while the runtime entity lives under `src/Entity/Persistence/Attachment/`; documentation must be reconciled when the canonical target is finalized.
- `Canon018` Composer identity mapping: `attaching/attachment` correctly maps component `Attaching` to namespace `App\Attaching\`; subject vocabulary is `Attachment*` for component-owned PHP types.
- `Canon019` no alternative layer taxonomy: no `src/Domain`, `Application`, `Infrastructure`, `Port`, `Adapter`, or `Adaptor` root is to be introduced.

### Market / maturity opening mixin
- Baseline attachment/media products expect association/linking, validation, metadata, multiple storage backends, lifecycle-safe deletion, and reliable downloads.
- Mature growth capabilities commonly include derivative/conversion pipelines, responsive media, richer collection metadata, async processing, and multi-filesystem backends.
- Those capabilities are post-RC growth for Attaching unless required for correctness or operability; they must not broaden the current component boundary.

### RC-critical workstream selected
Restore Doctrine mapping correctness for `Attachment` after Objecting adoption, then verify the complete affected runtime path. PHPUnit currently reports 10 integration errors with one root cause: duplicate Doctrine column `status` on `App\Attaching\Entity\Persistence\Attachment\Attachment`.

Initial evidence shows the collision is factual: Attaching maps a local enum property as column `status`, while Objecting's `ObjectStateEmbeddable` also maps `objectStatus` to the physical column `status` through `ObjectStateEmbeddableTrait` with `columnPrefix: false`. The fix must preserve one authoritative current model and Objecting's system-field ownership rather than hiding the collision.

### Growth workstream (non-blocking for RC)
- Storage-driver expansion beyond the local baseline.
- Media derivatives/conversions and responsive variants.
- Async post-upload processing and richer metadata/collection policy.
- UX/API capability growth only after the correctness and architecture gates are green.

### Baseline gates
- `composer validate --strict`: PASS.
- `composer phpstan`: PASS (`No errors`).
- `composer test`: FAIL (10 integration errors; duplicate Doctrine column `status`).
- `composer cs:check`: PASS (0 of 92 files require fixes).
- Doctrine mapping/runtime verification: pending after repair.
- Canon/Gating checks: inspect/apply available target-local executable policy after the mapping blocker is repaired; do not modify the pre-existing untracked `.gating/` without explicit need.

### Risks / constraints
- Objecting owns system-field packs; a local clone or second system-status column would recreate the duplication the platform canon is removing.
- The local business `AttachmentStatus` enum may still be valuable as domain vocabulary, but its persistence mapping must not collide with canonical Objecting state storage.
- Tree canonization must not be mixed blindly into the mapping repair; topology changes require complete caller/config/test/docs synchronization.
- Writes remain confined to Attaching. Canonization, Gating, Objecting, Cruding, Viewing, and Interfacing are read-only references for this task.

### Next bounded step
Iteration 2: implement the smallest coherent Attaching-only mapping repair that removes the `status` collision while retaining the intended attachment lifecycle API, update directly affected tests/docs if required, and run PHPUnit plus static/style checks on the resulting state.

Что имеем? Фактический RC-блокер локализован до конфликта local `status` и Objecting `object_state.status`; package identity and PHPStan baseline зелёные.

Что осталось? Материально исправить mapping в iteration 2, проверить Doctrine/runtime behavior и закрыть оставшиеся canon/documentation tails перед integration/acceptance.

## 2026-09-11 — Iteration 2/5: material implementation

### Implemented repair
+- Removed the duplicate local Doctrine-mapped `Attachment::$status` property.
+- Preserved the public `AttachmentStatus` lifecycle API by deriving `getStatus()` from Objecting's canonical `object_state.status` value.
+- `markDeleted()` and `restore()` now mutate only the Objecting state pack for lifecycle status, avoiding parallel persistence state.
+- Updated Doctrine repository predicates to query `objectState.objectStatus` and bind scalar enum values because Objecting persists that field as a string.
+
+### Verification
+- Changed-file PHP lint: PASS (3/3 PHP files).
+- `composer test`: PASS — 30 tests, 221 assertions.
+- `composer phpstan`: PASS — no errors.
+- `composer cs:check`: PASS — 0 of 92 files require fixes.
+- `doctrine:schema:validate --env=test`: mapping PASS; local test database schema reports out-of-sync. No destructive schema reset/update was performed because destructive operations are forbidden by the task capability envelope. The passing integration suite rebuilds/uses its controlled test schema path and validates the repaired mapping behavior.
+
+### Resulting invariant
+`ObjectStateEmbeddable` is the single persisted owner of attachment lifecycle status. `AttachmentStatus` remains Attaching-owned business vocabulary exposed by the entity API, not a second Doctrine column.
+
+Что имеем? Исходный duplicate-column fail устранён; runtime integration tests, static analysis, syntax and style gates are green.
+
+Что осталось? Commit this coherent repair, then iteration 3 should inspect the resulting state for schema/migration and canon/documentation tails, including stale prefixed Objecting column references, without modifying sibling repositories.

## 2026-09-11 — Iteration 3/5: verification and fix

### Verification findings
- Read-only RC diagnostic reports `rc_diagnostic_green` with zero canon issues for the current runtime tree.
- Manual executable-surface review found a false-green tail in `app:attachment:migrate-identifiers`: the PostgreSQL rebuild path still emitted legacy `object_*` Objecting columns and both `status` plus `object_status`.
- Historical Doctrine migration files still document the earlier transition shape. They were not rewritten in this iteration because they are irreversible migration history; the active maintenance command is the executable path that could recreate the stale schema and therefore required correction.

### Implemented fix
- Updated `MigrateAttachmentIdentifiersCommand` to recreate current Objecting physical columns: `uuid`, `slug`, title fields, audit fields, `active`, `enabled`, and canonical `status`.
- Removed duplicate `object_status` persistence from the rebuild SQL and aligned `status` length to Objecting's 64-character mapping.
- Updated attachment-link audit columns in the same rebuild path to current unprefixed Objecting names.
- Added a regression assertion in `AttachmentTreeLayerTest` preventing reintroduction of key `object_*` columns in the executable identifier migration.
- Updated README persistence-path wording to the actual `src/Entity/Persistence/Attachment/` location.

### Verification
- Changed-file PHP lint: PASS (2/2 PHP files).
- `composer validate --strict`: PASS.
- `composer test`: PASS — 31 tests, 228 assertions.
- `composer phpstan`: PASS — no errors.
- `composer cs:check`: PASS — 0 of 92 files require fixes.
- RC diagnostic: GREEN, zero canon issues.

Что имеем? Runtime и destructive maintenance path теперь описывают одну и ту же текущую Objecting physical schema; README также синхронизирован с runtime tree.

Что осталось? Создать отдельный coherent iteration-3 commit; iteration 4 затем закрывает integration/release tails и Git publication posture.

## 2026-09-11 — Iteration 4/5: debt closure and integration

### Integration findings
- Branch `refactor/canonical-attachment-tree-v2` tracks `origin/refactor/canonical-attachment-tree-v2`, is ahead by two commits and behind by zero.
- RC validation is green: Composer validation, PHPStan, PHPUnit, and canon checks passed with zero blockers.
- CI and release documentation use the same PHP 8.4 quality contour as local verification.
- `composer audit` exposed a previously uncovered RC blocker: 12 security advisories across 6 locked dependencies, including high-severity Symfony MIME and Security HTTP advisories.

### Debt closure selected
- Refresh the affected Symfony dependency locks within existing package constraints.
- Re-run Composer audit and all local quality gates.
- Update `CHANGELOG.md` with the lifecycle mapping, identifier-migration schema, and dependency-security fixes.

Что имеем? Functional/canon integration is green, but dependency security is a real RC blocker and is being closed in this iteration.

Что осталось? Complete the scoped Composer refresh, require a green audit and full gate set, then commit the release/security closure.

### Security remediation result
- Updated affected Symfony packages and required transitive dependencies to patched releases within existing constraints; the lock now includes current Symfony 8.1 security-fixed versions.
- Removed unintended `objecting/object` dev-master lock drift introduced by the first dependency resolution so this Attaching task does not silently advance a sibling component revision.
- `composer audit`: PASS — no security vulnerability advisories found.
- `composer validate --strict`: PASS.
- `composer test`: PASS — 31 tests, 228 assertions.
- `composer phpstan`: PASS — no errors.
- `composer cs:check`: PASS — 0 of 92 files require fixes.

Что имеем? Functional, canon, dependency-security and release-documentation contours are green; branch remains integration-ready with only the pre-existing untracked `.gating/` outside this task's owned changes.

Что осталось? Commit this debt-closure batch. Iteration 5 should perform final acceptance/release review and decide publication/push according to the original Git policy.

## 2026-09-11 — Iteration 5/5: final acceptance and publication

### Final acceptance
- Bounded RC validation is green: Composer validation, PHPStan, PHPUnit, and canon checks pass with zero blockers or warnings.
- Dependency security remains green after remediation: the previous iteration's Composer audit reported no advisories.
- Branch `refactor/canonical-attachment-tree-v2` is ahead of its configured upstream and behind by zero. The pre-existing local `.gating/` execution-policy copy is now explicitly ignored via `/.gating/` so it cannot be accidentally staged and no longer leaves the repository permanently dirty.
- Existing PR #3 targets `master` from this branch and is mergeable at the Git level. Its historical GitHub Actions checks are failed, so remote merge must remain subject to the repository merge gate after the updated branch is pushed.
- The full RC wrapper timed out once during final acceptance, but the bounded RC validator completed successfully and reproduces the required local validation contour.

### Terminal state
No further Attaching code, schema, documentation, dependency-security, or canon blockers were found within the execution budget. The task is ready for branch publication and PR re-evaluation.

Что имеем? Пять итераций materially completed; all owned changes are committed and local acceptance is green.

Что осталось? Push the current branch, inspect PR #3 against the new head, and merge only if the safe merge gate permits it.

## 2026-09-13 — Iteration 1/5: reconnaissance and canonical baseline

### Scope and repository state
- Write boundary remains `Attaching` only (`D:\PhpstormProjects\www\attaching`); sibling repositories are read-only contract sources.
- Branch at baseline: `refactor/canonical-attachment-tree-v2`; worktree was clean before this run.
- The previous 2026-09-11 RC wave is preserved as historical evidence but was not assumed current without verification.
- Current repository is a dual-mode Symfony component because it exposes `bin/console`, `config/bundles.php`, and `App\Attaching\AttachingBundle`.

### Material read surface
- Attaching: `AGENTS.md`, `README.md`, `composer.json`, prior `CMCP_CHANGELOG.md`, standalone bundle/configuration surfaces, component service/route exports, PHPUnit/PHPStan/PHP-CS-Fixer configuration, CI, release and integration documentation, and RC inventory/diagnostic output.
- Canonization: normative architecture rules Canon004, Canon005, Canon007, Canon008, Canon010, Canon017, Canon018, Canon019, Canon020, Canon021, Canon022, Canon023, Canon024, Canon025, Canon026, Canon029, Canon030, Canon031, Canon032, Canon033, Canon037, Canon039, and Canon040 plus the architecture guard matrix.
- Gating: repository responsibility and package contract; treated as executable enforcement companion rather than the normative source.
- Runtime dependency contour: Objecting, Cruding, Collectioning, Tabling, Viewing, and Interfacing package identities, responsibilities, bundle surfaces, and current Composer contracts were inspected. Objecting system-field ownership remains authoritative for lifecycle/system fields.
- A bounded RC diagnostic reported green with zero canon findings, but direct comparison with current textual Canonization revealed missing hard requirements; this run therefore treats that diagnostic as incomplete rather than authoritative.

### Target-to-canon mapping
- Canon004/005/007/018/019/020: retain role-first `App\Attaching\` topology and literal PSR-4 identity; do not introduce alternative layer taxonomies or ceremonial subject folders.
- Canon008/022: standalone Attaching must declare direct runtime dependencies on `cruding/crud`, `collectioning/collection`, `tabling/table`, `viewing/view`, `interfacing/interface`, `objecting/object`, and `easycorp/easyadmin-bundle`.
- Canon021: attachment-specific upload/download/attach/detach operations stay component-owned; no generic CRUD engine is to be introduced locally.
- Canon023: development SmartResponsor dependencies use sibling Composer path repositories with `symlink: true`.
- Canon024/033: add a path-independent `composer.prod.json` that preserves package/type/PSR-4/PHP/Symfony identity parity with development.
- Canon025/032: preserve both standalone and reusable-bundle execution; verify standalone bundle registration after dependency wiring changes.
- Canon026: raise the Symfony platform floor from `^8.0` to `^8.1` while keeping PHP `^8.4`.
- Canon029/039/040: existing PHPStan, PHP-CS-Fixer and PHPUnit surfaces are present; coverage execution/evidence requires explicit closure because the current Composer scripts expose no persistent branch-coverage summary.
- Canon030: because Attaching owns Doctrine entities and migrations, an executable isolated schema-parity contract is required; current scripts do not yet expose one.
- Canon037: tracked `config/reference.php` is prohibited generated source and must be untracked/ignored rather than maintained as authoritative configuration.
- Canon010/017: all package/config/test/docs surfaces changed by this migration must remain synchronized.

### Market / maturity opening mixin
- Mature attachment systems baseline secure server-side validation, content-aware MIME handling, storage outside the public webroot or on a separate storage host, lifecycle-safe deletion, and reliable download authorization.
- Advanced enterprise maturity commonly adds object storage, pre-signed/direct upload paths, malware/quarantine scanning, asynchronous processing, derivatives/conversions, and richer metadata/collection policies.
- These advanced capabilities remain a separate growth track and do not block this RC unless a concrete current correctness or safety defect requires them.

### RC-critical workstream selected
Close the current Canonization packaging/runtime-contract drift without changing Attaching business responsibility: align development and production Composer manifests, direct platform dependencies, Symfony 8.1 baseline, standalone bundle/runtime registration, generated-artifact policy, test tooling evidence, and Doctrine schema-parity execution. Then run the complete affected validation surface.

### Growth workstream (non-blocking for RC)
- Flysystem/object-storage driver support and provider-neutral storage configuration.
- Direct/pre-signed uploads where appropriate.
- Malware scanning/quarantine and asynchronous post-upload processing.
- Derivatives/conversions, richer metadata, and UX/API improvements after the canonical RC baseline is green.

### Risks and safeguards
- Do not modify dirty sibling worktrees such as Objecting; only consume their published/local package contracts.
- Avoid dependency lock drift beyond the explicitly required baseline packages and Symfony 8.1 contour.
- Do not register helper bundles speculatively; registration must follow actual standalone runtime needs and bundle contracts.
- Generated artifacts are removed from tracking only after confirming Canon037 and ignore coverage.

### Material implementation started
- `composer.json` now declares the current Canon022 baseline packages directly, raises Symfony constraints to `^8.1`, uses local path/symlink repositories for the six SmartResponsor sibling dependencies, and enables development stability needed for local branch packages.

### Gates planned
- Composer validation and dependency resolution/audit.
- PHP syntax, PHPStan, PHPUnit and CS check.
- Symfony container/YAML/runtime boot validation.
- Doctrine mapping and isolated schema/migration parity where the repository can execute it safely.
- Current textual Canonization/Gating review plus final bounded RC validation.

Что имеем? Current textual canon has been mapped explicitly and the first package-contract repair is already materialized in the development manifest; the earlier green RC diagnostic is known to be false-green for newly materialized canon rules.

Что осталось? Complete the production manifest, runtime/bundle and hard-canon tails, update the lock safely, verify the executable repository state, then commit/publish/integrate only from a fully green result.

## 2026-09-13 — Iteration 2/5: material implementation

### Implemented
- Aligned development and production Composer contracts to the current Canon022/023/024/026 dependency and Symfony 8.1 baseline.
- Added the direct `symfony/event-dispatcher` runtime dependency and explicitly registered Symfony 8.1 `ServicesBundle` in the standalone and embedded-test bundle maps; this closes the manual `registerBundles()` gap exposed by FrameworkBundle's `RequiredBundle` contract.
- Untracked generated `config/reference.php` while preserving the local generated file under ignore policy.
- Added persistent PHPUnit path/branch coverage configuration and a stable `test:coverage` artifact at `var/coverage-summary.txt`.
- Added Doctrine Migrations Bundle, an overrideable `DATABASE_URL`, migration namespace configuration, and a clean-install PostgreSQL baseline migration.

### Verification
- PHPUnit after the ServicesBundle repair: PASS — 31 tests, 228 assertions at the repair checkpoint.
- PHPStan: PASS.
- CS check: PASS.
- `debug:container event_dispatcher`: PASS; the Symfony 8.1 dispatcher service is now present.

Что имеем? Symfony 8.1 standalone/test runtime is functional and the hard package/runtime canon gaps are materially closed.

Что осталось? Close Canon030 migration-chain parity and verify the complete resulting state rather than relying on the previous false-green RC wrapper.

## 2026-09-13 — Iteration 3/5: verification and fix

### Canon030 findings and repair
- Existing migrations could not reproduce current metadata from an empty database: the first historical migration required pre-existing attachment tables, and historical Objecting adoption used stale `object_*` and snake_case physical columns.
- Added `Version20260818000000` as an idempotent clean-install PostgreSQL baseline matching current Doctrine physical metadata.
- Hardened the two historical migrations so they become no-ops when the canonical baseline is already present.
- Added `Version20260913000000` to converge legacy snake_case and `object_*` deployments to the current physical schema.
- Updated `MigrateAttachmentIdentifiersCommand` so its destructive rebuild path emits the same current Doctrine physical columns, indexes, FK identity, nullable status, and camelCase business-column names instead of recreating drift.
- Updated the architecture regression test to assert the current maintenance-command DDL contract.

### Executable schema-parity contract
- Added Composer `schema:parity`: full migration chain, `doctrine:migrations:up-to-date`, then `doctrine:schema:validate`.
- Added disposable PostgreSQL 17 service and `pdo_pgsql` to CI; the CI job now executes `composer schema:parity`.
- Fixed the Doctrine Migrations YAML namespace after executable discovery exposed doubled literal backslashes; `doctrine:migrations:list` now sees all four migrations.
- Local PostgreSQL is not configured in this workspace, so production migration execution is intentionally delegated to the new disposable PostgreSQL CI contract rather than falsely proven against SQLite.
- Local `doctrine:schema:validate`: mapping PASS; existing local SQLite schema remains out of sync, as expected for a non-disposable pre-existing database.

### Verification
- Changed PHP lint: PASS — 8/8.
- Composer strict/check-lock: PASS.
- PHPUnit: PASS — 31 tests, 231 assertions.
- PHPStan: PASS — 0 errors.
- CS check: PASS — 0 of 92 files require fixes.
- Composer audit: PASS — no advisories.

Что имеем? Migration discovery, current metadata, maintenance DDL and CI schema-parity execution now describe one canonical schema model.

Что осталось? Measure final coverage, run bounded RC validation, record debt correctly, then integrate only if the repository gate is otherwise green.

## 2026-09-13 — Iteration 4/5: debt closure and integration readiness

### Coverage and RC evidence
- `test:coverage`: PASS with Xdebug 3.5.1 and persistent summary.
- Final measured coverage: lines 67.32%, methods 56.94%, branches 71.31%, paths 29.90%.
- Canon040 target 80/80/70 is not fully reached; branches exceed target while line/method coverage remains measured debt. The result is above the HIGH_TEST_DEBT floor and is recorded as non-hard remediation debt rather than hidden or misreported as target attainment.
- Bounded RC validator: Composer validation PASS, PHPStan PASS, PHPUnit PASS, coverage execution PASS, canon issue count 0. The only readiness blocker is the expected dirty-worktree state before integration.

### Integration posture
- Branch `refactor/canonical-attachment-tree-v2` tracks `origin/refactor/canonical-attachment-tree-v2`, ahead by one and behind by zero before the final commit.
- One earlier signed helper commit `2ace4c7` has an undesirably temporary message `tmp`; no amend capability is exposed by Console MCP, so history is not destructively rewritten. The final coherent commit will carry the meaningful RC closure and the handoff records this hygiene tail explicitly.

Что имеем? All locally executable RC gates are green; remaining readiness blocker is only uncommitted owned work. Coverage shortfall is explicit measured debt, not a hidden blocker.

Что осталось? Commit the owned closure batch, push, inspect PR checks/mergeability against the new head, and merge only if the remote safe-merge gate is green.

## 2026-09-13 — Iteration 5/5: final acceptance and handoff

### Acceptance before publication
- Composer strict/check-lock: PASS.
- PHP syntax: PASS for all changed/untracked PHP files.
- PHPUnit: PASS — 31 tests, 231 assertions.
- PHPStan: PASS — no errors.
- PHP-CS-Fixer check: PASS — 0/92 files require fixes.
- Composer audit: PASS — no security advisories.
- Doctrine migrations are registered and discoverable: four versions listed.
- Doctrine mapping validation: PASS; disposable PostgreSQL full-chain parity is materialized as a CI gate because no local PostgreSQL alias/DATABASE_URL is available.
- RC validator: zero canon issues and zero executable validation failures; only pre-commit dirty state blocks readiness.

Что имеем? Attaching is locally acceptance-green with an executable production schema-parity contract and explicit coverage debt accounting.

Что осталось? Publish the final signed commit and re-evaluate the existing remote PR at its new head; do not claim remote merge completion until checks and safe-merge inspection confirm it.

## 2026-09-22 — Canonical structure debt closure

### Reconnaissance baseline
- Repository was clean before this pass.
- Blocking Gating rules: Canon001, Canon002, Canon003, Canon006, Canon018, Canon020, and Canon038.
- DTOs still use the legacy `Dto` root and lack the canonical `DTO` suffix; several declarations also violate the Composer subject prefix `Attachment`.
- Repository implementations use `Repository/Doctrine/Attachment` while their interfaces require the mirrored `Repository/Persistence/Attachment` tree.
- Query factories are under `Service/`, one service uses the mixed `ResolverService` role suffix, and the voter uses the now-noncanonical top-level `Voter` root.
- Five component-owned YAML files do not use the required `attachment_` subject prefix; runtime/tests/delivery manifests contain references to those paths.

### Selected bounded migration
- Normalize DTO casing/names, subject-prefixed declarations, technical-role roots, repository mirroring, and component YAML filenames in one symbol-safe migration.
- Update tests, service wiring, delivery metadata, and documentation references with the same symbol/path mapping.
- Preserve business behavior and database schema; no Entity or migration semantics are changed.

### Gates
- Composer validation, PHP-CS-Fixer, PHPStan, PHPUnit, and full Gating after the migration.
### Canonical structure migration completed
- Migrated legacy `Dto` DTOs to canonical `DTO` root with explicit `DTO` suffixes and `Attachment` subject-prefix naming.
- Aligned repository implementation trees with `RepositoryInterface` mirrors under typed `Persistence`, `Marketplace`, and `Runtime` roles.
- Moved query factories to `Factory/`, removed mixed `ResolverService` naming, normalized storage/service/command/controller/fixture subject prefixes, and synchronized callers/tests/docs.
- Renamed component-owned YAML surfaces to `attachment_*` filenames and updated service/runtime/delivery references.
- Added/updated behavioral UI test tooling surfaces required by the current Symfony testing canon.
- Hardened marketplace query scalar extraction for PHPStan-safe DBAL handling.
- Fixed SQLite integration-test isolation by resetting the whole test database with `SchemaTool::dropDatabase()` before recreating current metadata.
- Canon053 topology was committed separately: forbidden Collectioning/Objecting/Tabling live sibling symlinks were replaced with VCS package repositories while canonical Gating/Cruding/Viewing/Interfacing symlinks remain available.

### Final verification
- PHP-CS-Fixer: PASS.
- PHPStan: PASS, 0 errors.
- PHPUnit: PASS, 31 tests / 231 assertions.
- Full `composer quality`: PASS.
- Gating: PASS, 69 rules / 0 failures.
- Canon001/002/003/006/018/020/038/045/052/053 all PASS.
- Remaining Canon031/034/040/042 findings are warning-level documentation/evidence/gitignore debt and do not block the current quality contract.

### Superseded PR #4 reconciliation
- GitHub PR #4 is closed and conflicts with the advanced `master`; it must not be merged wholesale.
- Compared its RC-critical fixes against the current canonical branch after the entity-suffix/Gating migration.
- Carried forward the missing storage-boundary path confinement and its traversal regression test onto the current canonical `AttachmentLocalStorage` path.
- Carried forward the production `objecting/object` `dev-master` pin.
- Corrected operations documentation to the canonical maintenance command and storage implementation paths.
- Local GitHub Actions failures are intentionally non-blocking by repository policy; acceptance is local.

### Reconciliation verification
- Changed PHP lint: PASS.
- `composer quality`: PASS.
- PHPUnit: PASS — 41 tests / 241 assertions.
- PHPStan: PASS — 0 errors.
- PHP-CS-Fixer: PASS after normalizing one mixed line ending introduced during reconciliation.
- Gating: PASS — 69 rules / 0 failures; Canon031/034/040/042 remain warning-level debt only.
- Composer audit: PASS — no security advisories.
- Initial strict Composer validation exposed a topology mismatch introduced earlier in this branch: Collectioning/Objecting/Tabling had been switched to VCS repositories, making exact `dev-master` constraints depend on remote branches that do not exist for Collectioning/Tabling.
- Re-read current Canon043 and Canon053. Canon053 explicitly allows symlinked sibling repositories for Gating, Cruding, Viewing, Interfacing, Collectioning, Objecting, and Tabling; Canon043 requires local `path` dependencies to expose exact `dev-master` identity through `options.versions` even when the sibling checkout is on a feature branch.
- Restored all seven canonical first-party development dependencies to `path` + `symlink: true` + explicit `options.versions[package] = dev-master` identity.
- Regenerated the lock successfully; Panther/Test Pack are now present and all first-party dependencies resolve under canonical `dev-master` identity without modifying sibling repositories.
- Final strict `composer validate --strict --check-lock`: PASS.
- Final `composer audit --format=summary`: PASS, no advisories.
- Final `composer quality`: PASS — PHPUnit 41/241, PHPStan 0 errors, PHP-CS-Fixer clean, Gating 69 rules / 0 failures.

Что имеем? The canonical branch is rebased on current master, conflict-free, strict-lock reproducible, locally acceptance-green, and contains the substantive RC value of superseded PR #4.

Что осталось? Commit/publish this Composer-topology correction and merge the conflict-free replacement PR #8; GitHub Actions remain intentionally non-blocking by repository policy.