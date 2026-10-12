# CMCP Orchestration Journal

## 2026-10-12 — engine-20261004193617-attaching-ce0f9a canon revalidation

- Baseline: clean synchronized master `48117e0aa3f42689dfa4fb9ecd04630166bc8ea3`; read target AGENTS, README, Composer and gitignore, historical 2026-09-29 Gating/Inspecting reports, and Objecting/Cruding/Viewing/Interfacing/Gating/Canonization dependency contracts.
- Consulted normative Canonization `.canonization/Governance/Architecture/Rule/Canon052GatingIntegrationRule.md`: Attaching already declares the Composer development Gating dependency, path symlink, and quality entrypoint. Its ignored `.gating/` must hold generated artifacts only. Historical RED is not proof of current gate behavior; existing journal documents repeated GREEN contemporary Composer quality runs.
- RC-critical: verify current gating evidence before deciding whether ignored legacy tooling is safe to change; preserve unrelated local artifacts. Review attachment lifecycle failure handling and regression safety within component boundary.
- Growth (post-RC): resumable transfer, richer retention controls, operational metrics. Do not treat speculative scope as RC gate.
- Risks: ignored `.gating/` may include user-local tooling; destructive cleanup expressly forbidden. PostgreSQL production schema parity and UI behavioral evidence are environment/applicability dependent.
- Implementation: documented storage-before-metadata orphan risk and stream ownership/cleanup guarantees in `AttachmentUploadService` and `AttachmentDownloadService` semantic PHPDoc; no runtime behavior or API change.
- Current `composer quality` pre-change and post-change both GREEN on PHP 8.4.13: PHP CS Fixer 0/98; PHPStan 0 errors; PHPUnit 47 tests / 255 assertions; Gating 0 failed / 0 warning (3 skipped without profile). Historical full CanonScanning RED is not reasserted as present failure or claimed cleared by this narrower gate.
- No UI files modified, so new visual artifact not applicable. No server or database restart performed; database/schema parity and behavioral UI applicability remain unverified. Current task reaches a verified documentation hardening checkpoint, not full RC acceptance.
- Status: deterministic quality GREEN; integration and remaining runtime/behavioral evidence subject to follow-up.

Что имеем? Normative Canon052 and clean local baseline, with historical RED and newer recorded GREEN distinguished.
Что осталось? CanonScanning/full-profile parity, applicable runtime/database and behavioral evidence, and guarded Git integration.

## 2026-10-12 — engine-20261004193010-attaching-d79e62 binary storage hardening

- Baseline: Windows Console MCP resolved D:\\PhpstormProjects\\www\\Attaching; clean master cf0167df2c959d73eba5348d8fe04675b065960f, origin/master synchronized.
- Read target README, AGENTS, Composer and source/tests; Objecting, Cruding, Viewing, Interfacing, Gating and Canonization agent contracts, and normative Canon052, Canon021 and Canon031 textual rules. Consulted 2026-09-29 CanonScanning RED report; current composer quality gate baseline was GREEN (45 tests / 253 assertions), so stale RED must not justify destructive tooling cleanup.
- Canon mapping: Canon052 development Gating dependency, local symlink, quality script and artifact-only .gating follow target Composer; Canon021 generic CRUD remains owned by Cruding, attachment transfers stay component-specific; Canon031 requires meaningful PHPDoc improvement but is advisory at current scope. Symfony App\\Attaching namespace and typed layer structure retained. Existing production package wiring and deployed database parity still warrant external proof.
- RC-critical change: local storage readStream translates failed reads into AttachmentStorageException without emitting fopen warnings. Regression cases exercise opaque binary bytes and missing-file failure. No UI, router, browser runtime, or database migration changed.
- Post-change composer quality PASS on PHP 8.4.13: PHP CS Fixer 0/98, PHPStan 0 errors, PHPUnit 47 tests / 255 assertions, Gating 0 failed / 0 warnings (3 profile skips). No user-facing UI files changed; visual evidence not applicable. Remaining verification: deployment/schema parity on an authorized isolated database and any externally required acceptance checks. Growth backlog (non-RC): richer diagnostics and resumable transfer capability.

Что имеем? Clean repository baseline, current green pre-change quality evidence, focused read-stream robustness change and tests.
Что осталось? Post-change verification, guarded integration, and unverified runtime parity.


## 2026-10-12 — engine-20261004191457-attaching-339828 stream hardening

- Baseline: clean `master` at `2b2e886f4fc9cce9d1df0cb9355940ae54f1e8e3` before changes; reused upstream 2026-09-29 CanonScanning reports only as historical evidence.
- Read component README/AGENTS/Composer manifests and attachment upload/download services; owner helper README/AGENTS/Composer manifests for Objecting, Cruding, Viewing, Interfacing and Gating. Consulted normative `Canon052GatingIntegrationRule.md` in Canonization.
- Canon052 mapping: `gating/gate`, symlink repository, `gate` and aggregate `quality` scripts are present. Historical RED for copied `.gating/` is not proof of current failure; do not delete ignored owner/tooling trees without current ownership evidence. Canon021: generic CRUD belongs in Cruding; download is attachment business action. Root namespace `App\\Attaching\\` retained.
- RC-critical fix: attachment streaming now uses try/finally so the file handle closes after successful or failing output. Tests and quality gates are required after this mutation.
- Residual risks: runtime database/schema parity and UI coverage need environment-applicable proof; Inspecting has maintainability observations. Growth track, non-blocking: storage observability and attachment API DX.

Что имеем? Verified repository baseline and bounded download resource-safety fix.
Что осталось? Complete post-change quality verification, safe Git integration, and remaining applicable runtime evidence.


## 2026-10-12 — engine-20261004184448-attaching-60cae0 baseline revalidation

- Authority: Windows Console MCP; workspace resolved to D:\\PhpstormProjects\\www\\Attaching. Current branch master, HEAD 887ac86b30a231028cd7b6865b278d2a92dc2bae, synchronized with origin/master (ahead 0, behind 0), clean before checks.
- Read task specification; target AGENTS.md, README.md, composer.json, .gitignore and existing journal; consulted helper AGENTS.md/README.md/composer.json from Objecting, Cruding, Viewing and Interfacing, plus Canonization and Gating projections. Canonization textual catalog is authoritative; full applicable normative rule inventory is not yet confirmed.
- Historical 2026-09-29 CanonScanning Gating RED: canon.052.gating_integration, consumer .gating state. Historical Inspecting: five medium maintainability observations; Semgrep timed out. These historical reports do not establish current failures.
- Current deterministic acceptance: composer quality PASS on PHP 8.4.13: PHP CS Fixer 0/98 changes, PHPStan no errors, PHPUnit 45 tests/253 assertions, Gating 0 failed/0 warnings (3 profile-dependent skips). Existing .gitignore excludes /.gating/, /node_modules/ and local env/OS noise; do not delete ignored local tooling on stale evidence.
- Canon mapping: App\\Attaching namespace and Symfony typed roles follow canonical component organization; generic application CRUD remains Cruding-owned; Objecting fields and helper boundaries remain application dependencies, not embedded replacements. Further canonical textual rule-file cross-check remains open.
- RC-critical workstream: verify remaining normative canon scope, deployment/schema parity, actual UI/behavioral coverage where applicable and inspect current post-check Git state; do not claim release acceptance until applicability and evidence are established. Growth workstream (not RC-blocking): consider richer attachment lifecycle observability, resumable uploads and administrative UX based on explicit product scope and tests.
- Runtime/schema verification attempt: `composer run-script schema:parity` FAILED (exit 1) because its `prod` Doctrine migration requires PostgreSQL; current connection was rejected by the migration. No retry or database reconfiguration was attempted. Schema parity remains NOT_VERIFIED on the required PostgreSQL environment.
- This pass changes orchestration documentation only; no user-facing UI change, screenshot not applicable. No runtime restart.

Что имеем? Clean current master and verified green deterministic quality suite; historic RED is not reproduced by today's configured Gating.
Что осталось? Complete factual current canonical rule cross-check and applicable runtime/behavioral checks before closing the autonomous task.

## 2026-10-11 — engine-20261004101523-attaching-59bf91 current baseline

- Windows Console MCP resolved the authoritative Attaching workspace; branch `rc/attaching-doc-runtime-drift-publish-20261005`, HEAD `2dc9996314b82d5a8f8e4a9fa26039a3346bc89e`, clean worktree and synchronized upstream (ahead 0 / behind 0).
- Read the complete task specification, current repository AGENTS.md, README.md, composer.json, .gitignore, prior orchestration journal, Canonization README/agent projection, and historic CanonScanning report dated 2026-09-29. Canonization normative rule catalog and complete helper contours remain to be cross-checked before any further architecture changes.
- Historic RED concerned `canon.052.gating_integration` and embedded `.gating/` material; current `.gitignore` excludes `.gating/`. Do not remove embedded files without proving ownership and tracked/untracked status. Historic warnings concerned PHPDoc coverage, ignore patterns, stale test-coverage output, and missing UI coverage evidence.
- Current deterministic checks: Gating PASS (0 errors, 0 warnings); composer validate PASS; PHPStan PASS (0 errors); PHPUnit PASS (45 tests, 253 assertions); PHP CS Fixer dry run PASS (0/98 files).
- RC-critical remaining: confirm any current report drift, evaluate Entity public API consumers, test PostgreSQL migration on an isolated disposable dataset, and verify master/PR merge status before completion. Growth-only ideas remain outside release acceptance.
- No UI files changed and no screenshot evidence generated; browser/mobile verification applicability depends on subsequent changes.

Что имеем? Clean synchronized feature branch and passing current deterministic gates, with outdated upstream RED no longer corroborated by current Gating.

Что осталось? Complete canonical/helper cross-checks, isolated migration verification where available, and master integration.

## 2026-10-05 — engine-20261004120050-attaching-28e0ae fresh-master documentation integration

### Isolation and reconciliation
- The historical PR #9 path was conflicting because it carried older branch history; no destructive rebase or force-push was used.
- A dedicated branch `rc/attaching-doc-runtime-drift-20261005` was created directly from current `origin/master` at `cbdb0972fa085cdd7c45e7f129dd6a227b1fbd83`.
- The parallel lifecycle/API branch was left untouched; this branch contains only the factual documentation repair for the current engine task.

### Material repair
- Corrected Antora architecture/API paths to the current typed Symfony tree (`Controller/Http`, typed Service/Repository roots, Maintenance/Runtime command roots).
- Corrected the documented Symfony floor from `^8.0` to the actual `^8.1` Composer baseline.
- Replaced stale bundle-only/no-root-bootstrap wording with the factual dual-runtime contract: reusable bundle exports plus repository-local `app/`, `bin/console`, and `config/` standalone verification runtime.
- Updated operations documentation to describe the standalone runtime while keeping host-specific composition outside Attaching business responsibility.

### Verification plan
- Run aggregate `composer quality`, strict Composer lock validation, Composer audit, and post-mutation Inspecting on this fresh-master branch.
- No browser/mobile UI behavior changed, so Panther/Playwright and visual screenshots are not applicable.
- If all local gates are green, create one signed commit, push the fresh branch, open a dedicated PR to `master`, and inspect the actual remote merge gate.

Что имеем? The documentation repair is now isolated on current master with no historical conflict baggage.

Что осталось? Deterministic acceptance, Inspecting, signed publication, and remote PR merge-safety verification.

### Acceptance verification
- Initial aggregate `composer quality` exposed one current-master hard blocker: Canon055 on `AGENTS.md`, `README.md`, and Antora index consumer-identity wording; CS, PHPStan, and PHPUnit were already green.
- Repaired exactly those Canon055 findings and additionally synchronized README runtime/Symfony statements with the same factual dual-runtime model used by the Antora pages.
- `composer gate`: PASS — 0 failures / 0 warnings; Canon055 is green.
- `composer phpstan`: PASS — 0 errors.
- `composer test`: PASS — 41 tests / 241 assertions.
- `composer cs:check`: PASS — 0/97 files require fixes.
- `composer validate --strict --check-lock`: PASS.
- `composer audit --format=summary`: PASS — no security vulnerability advisories.
- Post-mutation Inspecting: PHPStan analyzer 0 errors; five medium pre-existing structural observations remain on current master (four long-method findings and the 31-method AttachmentEntity advisory). No new finding was introduced by this documentation/canon repair.
- No browser/mobile UI source changed, so behavioral/UI screenshots remain not applicable.

Что имеем? Fresh-master documentation and Canon055 remediation is deterministic-green and externally inspected without historical branch conflict baggage.

Что осталось? Create one signed commit containing only the eight task-owned documentation/journal files, push this fresh branch, open a dedicated PR to `master`, and inspect its actual merge gate.

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

## 2026-10-11 — Canon034 hygiene remediation

### Baseline
- Read Attaching README, AGENTS, Composer manifests and prior orchestration journal; confirmed clean branch `rc/attaching-doc-runtime-drift-publish-20261005` before this edit.
- Read dependencies' README/Composer entrypoints: Objecting, Cruding, Viewing, Interfacing, Gating, Canonization; inspected September CanonScanning Gating and Inspecting reports, and the live `.gating/README.md` artifact boundary.
- The September Canon052 hard failure is stale: the current `.gating/` only contains its artifact README in the inspected source surface, and the previous journal records later passing checks. Five medium Inspecting observations remain historical, not proof of current failure.
- Consulted normative Canonization `.canonization/Governance/Architecture/Rule/Canon034GitignoreBaselineRule.md` and `Canon052GatingIntegrationRule.md`. Mapping: Attaching must ignore local environment, OS noise and node dependencies; Gating executable policies remain in the dependency, not the consumer `.gating/`.

### Selected RC work / growth boundary
- Added `.gitignore` coverage for `node_modules`, local dotenv overrides, macOS Finder and Windows Explorer noise; no source, entities, CRUD or runtime logic changed.
- RC gates: Composer gate, PHPStan, PHPUnit, formatting, and Git diff review. Inspecting rerun only if current scope changes warrant it.
- Growth track (not RC): external storage backends, media transformations, and asynchronous derivatives; stays outside this hygiene change.
- Market baseline: contemporary enterprise attachment implementations require upload validation, storage confinement, access control, deterministic retention, auditability, and safe lifecycle cleanup. No competitor parity claim is inferred from this hygiene patch.

Что имеем? Canon034 source hygiene patch is applied with a minimal scope.

Что осталось? Re-run deterministic gates and integrate only verified changes.

### Verified gates (2026-10-11)
- Composer manifest validation: PASS.
- `composer gate`: PASS, 10 rules, 0 failures, 0 warnings, 3 skipped (current gate profile).
- `composer phpstan`: PASS, 0 errors.
- `composer test`: PASS, 41 tests / 241 assertions.
- `composer cs:check`: PASS, 0/97 files.
- `git diff`: reviewed; only `.gitignore` and this journal changed.
- No user-visible UI changed; screenshots are not applicable to this patch.

Что имеем? Canon034 ignore coverage is materially improved; local deterministic checks are GREEN.

Что осталось? Publish the bounded change; broader PHPDoc/coverage maturity warnings remain separate nonblocking work.

## 2026-10-11 — engine-20261004100124-attaching-b6645d verification baseline

- Reconnaissance: confirmed clean `rc/attaching-doc-runtime-drift-publish-20261005` at `89f444979d327492d078dd0db5a5cc83b964acbf`, tracking origin without ahead/behind divergence.
- Read Attaching `AGENTS.md`, `README.md`, `composer.json`, `.gitignore`, service and route exports, current CMCP journal; read README and Composer contracts of Canonization, Gating, Objecting, Cruding, Viewing, Interfacing.
- Consulted Canonization `.canonization/Governance/Architecture/Rule/Canon052GatingIntegrationRule.md`: Attaching's `gating/gate` developer dependency, symlinked path repository, Composer gate and quality scripts, production package surface, and artifact-only `.gating/` are the mapping criteria.
- Reused historical CanonScanning September 29 report, which showed Canon052 RED due to executable and policy files under `.gating/`; journal records subsequent remediation. Current `.gitignore` explicitly excludes `.gating/`, node dependencies, local environment and OS noise. Historical Inspecting identified five medium structural observations; no current freshness claim is made.
- Current deterministic checks: `composer gate` PASS (10 rules, 0 failures); `composer phpstan` PASS (0 errors); `composer test` PASS (41 tests / 241 assertions); `composer cs:check` PASS (0 of 97 files); Inspecting capability is available.
- RC-critical workstream: ensure full CanonScanning Canon052 evidence is current, maintain security of attachment storage and lifecycle, and complete applicable release verification. Growth workstream: optional remote storage and asynchronous media derivatives, separate from RC.
- This journal entry records factual reconnaissance and verification, not a claim of completed RC or source remediation. No browser or user-observable UI changed in this pass.

Что имеем? Clean branch and green local quick gates, with explicit historical Canon052 evidence and normative rule mapping.

Что осталось? Full current CanonScanning/Inspecting acceptance where needed, targeted source remediation if actionable findings remain, and publication of coherent work.

## 2026-10-11 — engine-20261004100124-attaching-b6645d storage path hardening

- Continued from signed/published checkpoint `d5d1a0d` with a clean, upstream-synced branch.
- Inspected `AttachmentLocalStorage`, its PHPUnit path traversal regression test, and current Inspecting's medium findings. Selected a bounded security hardening fix instead of speculative refactoring of unrelated fixtures or migration logic.
- Hardened `AttachmentLocalStorage::normalizeRelativePath()` to reject any colon in a relative target. This closes Windows drive-relative `C:filename` and NTFS alternate data stream `filename:stream` spellings while preserving the existing absolute-path, traversal, empty-segment and NUL guards.
- Added focused PHPUnit coverage for both previously accepted spellings.
- Verified after mutation: `composer test` PASS (43 tests, 243 assertions); `composer phpstan` PASS (0 errors); `composer cs:check` PASS (0/97 fixable files); `composer gate` PASS (0 failures, 0 warnings).
- No browser/mobile UI, navigation or form behavior changed, so Playwright/Panther screenshots are not applicable to this storage-only change.

Что имеем? Tested rejection of additional Windows storage path escapes, with local deterministic gates green.

Что осталось? Post-change Inspecting and Git integration; broader Inspecting medium maintainability observations remain separate nonblocking backlog.

## 2026-10-11 — Attaching Inspecting maintainability remediation

- Started from clean, published commit `8aa4d3f`.
- Refactored `AttachmentMarketplaceFixture::attachRows()` to delegate per-owner materialization to `attachOwner()`, preserving validation, existing-link checks, storage copying, attachment persistence and final flush semantics.
- Verification: PHPUnit PASS (43 tests, 243 assertions), PHPStan PASS (0 errors), Gating PASS (0 failures), PHP-CS-Fixer PASS after correcting one spacing discrepancy.
- Post-mutation Inspecting: 4 medium findings versus 5 previously; marketplace long-method finding is resolved. Remaining findings: migration command long method, two demo-fixture long methods, and attachment entity public API breadth.
- No UI change, so screenshots are not applicable. Remaining structural observations require separate behavior-aware remediation rather than deleting public contracts.

Что имеем? One Inspecting maintainability finding resolved with deterministic local checks GREEN.

Что осталось? Review and safely remediate four remaining medium structural observations, and complete integration acceptance.

## 2026-10-11 — Attaching demo link fixture maintainability pass

- Continued on clean branch from published `a1b8703`, leaving existing attachment references and fixture persistence untouched.
- Refactored `AttachmentLinkFixture::load()` to use `linkDefinitions()`, with private `primaryLinkDefinitions()` and `additionalLinkDefinitions()` to keep the unchanged eight fixture records in their original order.
- `composer test`: PASS, 43 tests / 243 assertions; `composer phpstan`: PASS, 0 errors; `composer gate`: PASS, 0 failures; `composer cs:check`: PASS after `composer cs:fix` normalized array layout.
- Post-mutation Inspecting: 3 medium findings (down from 4), removing `AttachmentLinkFixture` long-method observation. Remaining: `AttachmentMigrateIdentifiersCommand::execute`, `AttachmentFixture::load`, and 31-method `AttachmentEntity` review.
- No user-visible UI changes; visual artifacts not applicable.

Что имеем? Two maintainability findings have been resolved over consecutive verified passes while preserving the 43-test baseline.

Что осталось? Three more behavioral/contract-sensitive observations and final integration acceptance.

## 2026-10-11 — Attaching demo attachment fixture extraction

- Continued from clean, published `402db53` and retained the existing fixture records, resource paths, hashes, enum values, and persistence order.
- Extracted `AttachmentFixture::load()` fixture definitions into three bounded private methods and moved persistence into `persistFixtures()`; used a precise PHPStan `AttachmentFixtureRow` shape to avoid weakening static checks.
- `composer phpstan` PASS (0 errors), `composer test` PASS (43 tests / 243 assertions), `composer cs:check` PASS, `composer gate` PASS.
- Post-mutation Inspecting: two remaining medium observations, down from three: migration command long method and attachment entity broad public API.
- No UI source changed; visual evidence not applicable.

Что имеем? Demo attachment fixture long-method observation resolved and deterministic checks green.

Что осталось? Review migration command and entity contract observations, and final branch integration.

## 2026-10-11 — Migration command refactoring and Entity API review

- Started from clean published `12793c5`; read the active migration command and attachment entity through Windows Console MCP.
- Refactored `AttachmentMigrateIdentifiersCommand::execute()` into transactional helper phases for legacy table preparation, attachment row insertion, link row insertion and existing reseeding. Preserved existing SQL bodies, statement order, begin/commit/rollback flow and PostgreSQL guard. Moved long attachment row copy SQL into an immutable private typed constant without SQL logic changes.
- Verified `composer phpstan`: 0 errors, `composer test`: 43 tests/243 assertions, and `composer gate`: 0 failures. Formatting normalized with `composer cs:fix`; repeat final cs check before commit.
- Post-mutation Inspecting: exactly one medium design observation remains, namely 31 public methods on `AttachmentEntity`; the migration long-method finding is resolved.
- Entity API review: getters, lifecycle methods and Objecting trait-backed status/audit form a public persistence contract; several timestamp aliases have no in-repository callers, but this does not establish absence of external package callers. Avoid deleting these methods merely to lower a numeric heuristic without a cross-repository compatibility inventory.
- No PostgreSQL migration was executed against live data; transaction integration requires a controlled disposable PostgreSQL dataset before any behavioral acceptance claim.
- No UI change; visual artifacts are not applicable.

Что имеем? Long-method remediation verified; remaining large-public-API finding is a medium compatibility-review advisory, not a demonstrated runtime defect.

Что осталось? Determine real external Entity method consumers before any public API reduction; optional isolated database migration exercise and final branch integration.

## 2026-10-11 — Attaching migration contract regression coverage

- Continued from clean published commit `b081795`; inspected current migration command, public `AttachmentEntity` consumers, Objecting `ObjectEntityInterface`, Composer runtime, and existing SQLite fixture integration tests.
- Added isolated `AttachmentMigrateIdentifiersCommandTest` with PostgreSQLPlatform/DBAL mock: already-migrated integer schema must be a no-op without transaction/SQL mutation; UUID schema must execute attachment and link migration stages, reseeding and legacy table cleanup in order inside begin/commit, without rollback on success.
- Verification: `composer test` PASS 45 tests/253 assertions (previously 43/243); `composer phpstan` 0 errors; `composer cs:check` PASS 0/98; `composer gate` PASS 0 failures and warnings; Inspecting stays at one medium `AttachmentEntity` API-breadth advisory.
- Scope: tests verify orchestration only; no disposable PostgreSQL schema migration performed, so real SQL execution/constraints remain unverified.
- Entity contract review confirms ORM link mapping, DTO factory, repository interfaces, fixture services, voter and Objecting-interface dependency in this repository. Public method removal is deferred until external consumers can be ruled out.

Что имеем? Additional executable migration regression evidence with 45 green tests and zero new Inspecting findings.

Что осталось? Disposable PostgreSQL end-to-end migration validation, external Entity method compatibility review, final integration acceptance.

## 2026-10-12 — engine-20261004192121-attaching-029741 reconnaissance and current acceptance

- Baseline: Windows Console MCP resolved Attaching to D:/PhpstormProjects/www/Attaching; clean master at dcebe020eb0fdced9d0db2d8da71d6f2b600588a, origin/master synchronized (ahead 0, behind 0).
- Read the task specification, Attaching AGENTS.md/README.md/composer.json, production manifest and Symfony bundle registration, relevant helper repository contracts, Canonization root documentation and normative Canon004, Canon007, Canon008, Canon018, Canon021, Canon022, Canon052, Gating README, and historical 2026-09-29 Attaching RED report. Existing journal records prior source and compatibility work.
- Historical Canon052 failure is not reproducible in today's aggregate Gating. Current `composer quality`: PASS, CS 0/98, PHPStan 0 errors, PHPUnit 45 tests/253 assertions, Gating 0 failed/0 warnings (3 skips); this is current evidence, not an inference from the historical report.
- Canon mapping: App\\Attaching\\ namespace corresponds to attaching/attachment (Canon007/018); generic CRUD remains Cruding-owned (Canon021); explicit declared helper packages satisfy the observed Composer contour (Canon008); local symlink development and packaged production Gating contracts match Canon052. Canon004's special Entity path rule requires deliberate separate topology analysis; no blind relocation.
- New normative Canon022 requires Failing as a direct standalone-runtime dependency and FailingBundle registration; current composer.json, composer.prod.json and config/bundles.php lack this dependency/registration. The requested sibling Failing/README.md was not accessible in this inspection, so do not inject unverified dependency wiring. Confirm its actual package/bundle surface and compatibility first.
- RC-critical: resolve verified Canon022 Failing runtime contour if its package is locally available; verify isolated PostgreSQL schema migration and cross-repository AttachmentEntity public method consumers. Growth-only: richer attachment lifecycle observability, resumable upload/storage backends; keep outside RC.
- No UI modification, no screenshot required; existing managed runtime was not restarted. No destructive action performed.

Что имеем? Current 45-test quality suite GREEN; historical RED is stale for current Gating; clean synchronized master.
Что осталось? Confirm Failing contract and safe integration, execute isolated PostgreSQL parity/behavioral verification, and close cross-repository compatibility review before RC completion.

### Canon022 remediation and acceptance

- Verified Failing/composer.json identity `failing/failure`, namespace `App\\Failing\\`, FailingBundle entrypoint and local repository registry. Added Failing to development and production runtime manifests, the local development symlink package repository, and Symfony config/bundles.php.
- Guarded Composer update for `failing/failure` succeeded (exit 0) and updated composer.lock; Composer also resolved seven existing local path dependencies plus new transitive dependency packages. No sibling repository sources were edited by this task.
- Post-change `composer quality`: PASS (CS 0/98, PHPStan 0 errors, PHPUnit 45/253, Gating 0 failure/0 warning/3 profile skips).
- `php bin/console lint:container --env=test`: PASS with FailingBundle enabled. No browser/UI files changed; visual verification not applicable.
- Remaining external acceptance: live PostgreSQL migration parity on isolated database and cross-repository public AttachmentEntity consumer review. These were not falsely marked green.

Что имеем? Canon022 runtime package/bundle drift repaired and local PHP/Symfony gates GREEN.
Что осталось? Preserve and integrate the verified patch; PostgreSQL schema and external consumer compatibility still require dedicated evidence.








